const aviatorService = require('../services/aviatorService');

module.exports = function (aviator_socket, Sequelize, sequelize, dateTime) {
    var moment = require('moment'); // require
    var format = require('date-format');
    const db = require('../models')
    const UserModel = db.user
    const GameModel = db.Aviator
    const setting_model = db.setting
    const AviatorBet = db.AviatorBet
    const DirectProfitStatement = db.DirectProfitStatement;
    const user_connected = 0;
    let connectCounter = 0;
    var avaitor_timer = 20
    var timer = avaitor_timer;
    var sec;
    var game_id = 0;
    var interval_id;
    var game_created = false;
    aviator_socket.on('connection', (socket) => {
        console.log('aviator connected')
        // aviator_socket.emit('aviator_timer', 'Game starts Soon...');
        socket.emit('aviator_timer', 'Game starts Soon...');
        // setInterval(aviator_timer_function, 15000);
    });

    function randomNumber(min, max) {
        return (Math.random() * (max - min) + min).toFixed(2);
    }

    // if(user_count>0){
    interval_id = setInterval(aviator_timer_function, 1000);
    // }


    // function getFlightSeconds(multiplier) {
    //     if (multiplier <= 1.0) return 0;

    //     const k = 0.7; // speed constant similar to Aviator
    //     return Number((Math.log(multiplier) / k).toFixed(2));
    // }

    function getFlightSeconds(multiplier) {
        if (multiplier <= 1) return 0;
        
        const speed = 0.1; // <-- slow, smooth like Aviator
        return Number((Math.log(multiplier) / speed).toFixed(2));
    }


    async function aviator_timer_function() {
        console.log("Timer:", timer);
        const user_count = aviator_socket.sockets.size;

        if (timer <= 0) {
            clearInterval(interval_id);
            console.log("User count:", user_count);

            const game_data = await getActiveGame();

            if (game_data) {
                // Set game status to 'in-progress'
                await aviatorService.update(game_data.id, { status: 1 });

                const bucket_amount_query = await getBucketAmount();
                if (!bucket_amount_query) return;

                const bucket_amount = bucket_amount_query.admin_coin;
                const total_bet_query = await getTotalBet(game_data.id);
                const total_bet = parseFloat(total_bet_query.get('total_amount')) || 0;
                const total_winning = parseFloat(total_bet_query.get('total_winning')) || 0;

                // Determine multiplier (sec)
                // if (total_bet === 0) {
                //     sec = parseFloat(randomNumber(5, 15)); // Random fly duration if no bets
                // } else {
                //     sec = bucket_amount / total_bet;
                //     if (sec > 3) {
                //         sec = parseFloat(randomNumber(2, 3));
                //     }
                // }
                if (!total_bet) {
                    sec = randomNumber(5, 100);
                } else {
                    sec = (bucket_amount / total_bet).toFixed(2);
                    if (sec > 100) {
                        sec = randomNumber(1, 100);
                        // if (sec > 1.7) {
                        //     sec = 1.4;
                        // }
                    }
                }

                sec = (sec < 1) ? 1 : sec;

                // Convert to blast duration
                const blastmillisecond = getFlightSeconds(sec);
                console.log("Blast multiplier:", sec, "| Duration (s):", blastmillisecond);

                const dt = dateTime.create();
                const current_datetime = dt.format('Y-m-d H:M:S');
                const end_time = moment(current_datetime).add(blastmillisecond, 'seconds').format('YYYY-MM-DD HH:mm:ss');

                // Update game with blast time and end time
                await aviatorService.update(game_data.id, {
                    blast_time: sec,
                    end_datetime: end_time
                });

                aviator_socket.emit('Game', {
                    time: 0,
                    game_id: game_data.id,
                    sec: 0
                });

                const admin_coin = total_bet - total_winning;

                // Finish the game AFTER the blast time ends
                setTimeout(async () => {
                    await aviatorService.update(game_data.id, {
                        status: 2,
                        total_amount: total_bet
                    });

                    console.log("Blast Now");
                    aviator_socket.emit('Blast', `Plane flew for this game id ${game_data.id} - blastmillisecond?=${sec}`);

                    // Start new game after blast
                    const dt = dateTime.create();
                    const current_datetime = dt.format('Y-m-d H:M:S');

                    const aviatorPayload = {
                        room_id: 1,
                        main_card: '',
                        status: 0,
                        winning_amount: 0,
                        user_amount: 0,
                        comission_amount: 0,
                        total_amount: 0,
                        admin_profit: 0,
                        winning: 0,
                        added_date: current_datetime,
                        updated_date: current_datetime
                    };

                    try {
                        const new_game = await aviatorService.create(aviatorPayload);
                        aviator_socket.emit('next_game_id', new_game.id);
                    } catch (error) {
                        console.error("Error creating new game:", error);
                    }

                    // Restart the timer for the next round
                    timer = avaitor_timer;
                    interval_id = setInterval(aviator_timer_function, 1000);

                }, blastmillisecond * 1000);
            } else {
                const dt = dateTime.create();
                const current_datetime = dt.format('Y-m-d H:M:S');
                game_created = true;
                const aviatorPayload = {
                    room_id: 1,
                    main_card: '',
                    status: 0,
                    winning_amount: 0,
                    user_amount: 0,
                    comission_amount: 0,
                    total_amount: 0,
                    admin_profit: 0,
                    winning: 0,
                    added_date: current_datetime,
                    updated_date: current_datetime
                }
                try {
                    const game = await aviatorService.create(aviatorPayload);
                    aviator_socket.emit('next_game_id', game.id)

                } catch (error) {
                    console.log(error)
                }

                interval_id = setInterval(aviator_timer_function, 1000);
                // }, 5000);
                timer = avaitor_timer;
            }
        } else {
            aviator_socket.emit('aviator_timer', timer);
            timer--;
        }
    }

    //Aviator table
    const getActiveGame = async () => {
        return await GameModel.findOne({ where: { status: 0 }, order: [['id', 'DESC']], attributes: ['id'], limit: 1 })
    }

    const getTotalBet = async (game_id) => {
        // console.log("game_id",game_id);
        // return Aviator.findOne({
        //     attributes: [
        //         [sequelize.fn('SUM', sequelize.col('amount')), 'total_bet'] // To add the aggregation...
        //     ], where: { dragon_tiger_id: game_id }
        // });

        return await AviatorBet.findOne({
            attributes: [
                [sequelize.fn('SUM', sequelize.col('amount')), 'total_amount'],
                [sequelize.fn('SUM', sequelize.col('winning_amount')), 'total_winning']
            ], where: { aviator_id: game_id }
        });
    }

    // 3. get user
    const getTotalUser = (aviator_id) => {
        return UserModel.findAndCountAll({ where: { aviator_room_id: aviator_id } })
    }

    const getBucketAmount = () => {
        return setting_model.findOne({ attributes: ['admin_coin'], where: { id: 1 } })
    }

    const directProfitStatementLog = async (source, admin_commission, source_id = 0) => {
        if (admin_commission) {
            const setting = await getSetting(1)
            let data = {
                admin_coin: Sequelize.literal('admin_coin+' + admin_commission),
            }
            setting_model.update(data, { where: { id: 1 } })
            var admin_current_wallet = parseInt(setting.admin_coin) + parseInt(admin_commission);
            console.log('current_Wallet', admin_current_wallet)
            console.log('admin_coin', setting.admin_coin)
            console.log('admin_commission', admin_commission)
            let info = {
                source: source,
                source_id: source_id,
                admin_commission: admin_commission,
                admin_coin: admin_current_wallet,
                added_date: format.asString(new Date()),
            }
            return DirectProfitStatement.create(info)
        }
    }

    const getSetting = (admin_id) => {
        return setting_model.findOne({ attributes: ['admin_coin'], where: { id: 1 } })
    }
}