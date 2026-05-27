// Dragon tiger start
// var request = require('request');

module.exports = function (dragon_tiger_socket, request, BASE_URL) {
    var game_created = false;
    var timer = 15;
    var interval_id;
    dragon_tiger_socket.on('connection', (socket) => {

        console.log("User Connected - " + socket.id);

        if (!game_created) {
            game_created = true;
            // Create Game
            var options = {
                'method': 'GET',
                'url': BASE_URL+'/api/cron/dragon_tiger_create_socket'
            };
            request(options, function (error, response) {
                if (error) throw new Error(error);

                // console.log("dragon_tiger_create_socket", response.body);
            });
            interval_id = setInterval(timer_function, 1000);
        }

        socket.on('dragon_tiger_timer', msg => {
            // connection.connect(function (err) {
            // console.log("Dragon Tiger Connected!");
            // });
        });

        dragon_tiger_socket.on("disconnect", (reason) => {
            console.log("User Disconnected - " + socket.id + " reason - " + reason);
        });
    });


    function timer_function() {

        if (timer <= 0) {
            var response = {};
            clearInterval(interval_id);

            // Make Winner
            var options = {
                'method': 'GET',
                'url': BASE_URL+'/api/cron/dragon_tiger_winner_socket'
            };
            request(options, function (error, response) {
                if (error) throw new Error(error);
                game_created = false;
                // console.log("dragon_tiger_winner_socket", response.body);

                // Send Status
                var options = {
                    'method': 'POST',
                    'url': BASE_URL+'/api/dragonTiger/get_active_game_socket',
                    'headers': {
                        'token': 'REDACTED-MOVED-TO-ENV-LEGACY',
                        'Cookie': 'ci_session=ql4u3d0569peintlo3clko0vftbg0ni2; ci_session=2g8l0mfnnlcim6jp1lthsivp6583rli8'
                    },
                    formData: {
                        'room_id': 1
                    }
                };
                request(options, function (error, response) {
                    if (error) throw new Error(error);
                    // console.log(response.body);
                    // console.log("dragon_tiger_status", "status");
                    dragon_tiger_socket.emit('dragon_tiger_status', response.body);

                });

                var user_count = dragon_tiger_socket.sockets.size;
                // console.log("user_count - ", user_count);
                // console.log("game created - ", game_created);
                if (user_count > 0 && !game_created) {
                    game_created = true;
                    setTimeout(function () {

                        // Create Game
                        var options = {
                            'method': 'GET',
                            'url': BASE_URL+'/api/cron/dragon_tiger_create_socket'
                        };
                        request(options, function (error, response) {
                            if (error) throw new Error(error);

                            // console.log("dragon_tiger_create_socket", response.body);
                        });

                        // // Send Status
                        // var options = {
                        //     'method': 'POST',
                        //     'url': BASE_URL+'/api/dragonTiger/get_active_game_socket',
                        //     'headers': {
                        //         'token': 'REDACTED-MOVED-TO-ENV-LEGACY',
                        //         'Cookie': 'ci_session=ql4u3d0569peintlo3clko0vftbg0ni2; ci_session=2g8l0mfnnlcim6jp1lthsivp6583rli8'
                        //     },
                        //     formData: {
                        //         'room_id': 1
                        //     }
                        // };
                        // request(options, function (error, response) {
                        //     if (error) throw new Error(error);
                        //     // console.log(response.body);
                        //     // console.log("dragon_tiger_status", "status");
                        //     dragon_tiger_socket.emit('dragon_tiger_status', response.body);

                        // });

                    }, 5000);
                    setTimeout(function () {
                        interval_id = setInterval(timer_function, 1000);
                    }, 10000);

                    timer = 15;
                }

            });


        } else {
            if (timer % 3 == 0) {
                // Send Status
                var options = {
                    'method': 'POST',
                    'url': BASE_URL+'/api/dragonTiger/get_active_game_socket',
                    'headers': {
                        'token': 'REDACTED-MOVED-TO-ENV-LEGACY',
                        'Cookie': 'ci_session=ql4u3d0569peintlo3clko0vftbg0ni2; ci_session=2g8l0mfnnlcim6jp1lthsivp6583rli8'
                    },
                    formData: {
                        'room_id': 1
                    }
                };
                request(options, function (error, response) {
                    if (error) throw new Error(error);
                    // console.log(response.body);
                    // console.log("dragon_tiger_status", "status");
                    dragon_tiger_socket.emit('dragon_tiger_status', response.body);

                });
            }

            // console.log("dragon_tiger_timer", timer);
            dragon_tiger_socket.emit('dragon_tiger_timer', timer);
            timer--;
        }
    }
}

// Dragon Tiger End