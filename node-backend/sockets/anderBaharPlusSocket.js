// Ander Bahar start
// var request = require('request');
const anderBaharPlusController = require("../controllers/api/anderBaharPlusController");
module.exports = function (ander_bahar_plus_socket, request, BASE_URL) {
    var game_created = false;
    // var place_bet_timer = 15;
    var place_bet_timer = 30;
    const roomId = 1;
    var timer = place_bet_timer;
    var interval_id;
    ander_bahar_plus_socket.on('connection', (socket) => {
        if (!game_created) {
            game_created = true;
            timer = place_bet_timer;
            anderBaharPlusController.createGame();
            interval_id = setInterval(timer_function, 1000);
        }

        socket.on('ander_bahar_plus_timer', msg => {
            // connection.connect(function (err) {
            // console.log("Ander Bahar Connected!");
            // });
        });

        socket.on("disconnect", (reason) => {
            console.log("User Disconnected - " + socket.id + " reason - " + reason);
        });
    });


    function timer_function() {

        if (timer <= 0) {
            var response = {};
            clearInterval(interval_id);

            // Make Winner
            anderBaharPlusController.declareWinner()
                .then(data => {
                    game_created = false;

                    var winning_seconds = data;

                    anderBaharPlusController.getActiveGameSocket(roomId)
                        .then(data => {
                            ander_bahar_plus_socket.emit('ander_bahar_plus_status', JSON.stringify(data));
                        })
                        .catch(error => {
                            console.log(error)
                        })
                    var user_count = ander_bahar_plus_socket.sockets.size;

                    if (user_count > 0 && !game_created) {
                        game_created = true;
                        setTimeout(function () {
                            // Create Game
                            anderBaharPlusController.createGame();
                            interval_id = setInterval(timer_function, 1000);
                        }, (winning_seconds * 1000) + 5000);

                        timer = place_bet_timer;
                    }
                })
                .catch(error => {
                    console.log(error)
                });

        } else {
            if (timer % 3 == 0) {
                // Send Status
                anderBaharPlusController.getActiveGameSocket(roomId)
                    .then(data => {
                        ander_bahar_plus_socket.emit('ander_bahar_plus_status', JSON.stringify(data));
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }

            // console.log("ander_bahar_plus_timer", timer);
            ander_bahar_plus_socket.emit('ander_bahar_plus_timer', timer);
            timer--;
        }
    }
}

// Ander Bahar End