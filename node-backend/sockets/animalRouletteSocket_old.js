// Ander Bahar start
// var request = require('request');

module.exports = function (animal_roulette_socket, request, BASE_URL) {
    var game_created = false;
    var timer = 15;
    var interval_id;
    animal_roulette_socket.on('connection', (socket) => {
        if (!game_created) {
            game_created = true;
            // Create Game
            var options = {
                'method': 'GET',
                'url': BASE_URL+'/api/cron/animal_roulette_create_socket'
            };
            request(options, function (error, response) {
                if (error) throw new Error(error);

                // console.log("animal_roulette_create_socket", response.body);
            });
            interval_id = setInterval(timer_function, 1000);
        }

        socket.on('animal_roulette_timer', msg => {
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
            var options = {
                'method': 'GET',
                'url': BASE_URL+'/api/cron/animal_roulette_winner_socket'
            };
            request(options, function (error, response) {
                if (error) throw new Error(error);
                game_created = false;
                // console.log("animal_roulette_winner_socket", response.body);

                // Send Status
                var options = {
                    'method': 'POST',
                    'url': BASE_URL+'/api/animalRoulette/get_active_game_socket',
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
                    // console.log("animal_roulette_status", "status");
                    animal_roulette_socket.emit('animal_roulette_status', response.body);

                });

                var user_count = animal_roulette_socket.sockets.size;
                // console.log("user_count - ", user_count);
                // console.log("game created - ", game_created);
                if (user_count > 0 && !game_created) {
                    game_created = true;
                    setTimeout(function () {

                        // Create Game
                        var options = {
                            'method': 'GET',
                            'url': BASE_URL+'/api/cron/animal_roulette_create_socket'
                        };
                        request(options, function (error, response) {
                            if (error) throw new Error(error);

                            // console.log("animal_roulette_create_socket", response.body);
                        });

                        // // Send Status
                        // var options = {
                        //     'method': 'POST',
                        //     'url': BASE_URL+'/api/animalRoulette/get_active_game_socket',
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
                        //     console.log("animal_roulette_status", "status");
                        //     animal_roulette_socket.emit('animal_roulette_status', response.body);

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
                    'url': BASE_URL+'/api/animalRoulette/get_active_game_socket',
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
                    // console.log("animal_roulette_status", "status");
                    animal_roulette_socket.emit('animal_roulette_status', response.body);

                });
            }

            // console.log("animal_roulette_timer", timer);
            animal_roulette_socket.emit('animal_roulette_timer', timer);
            timer--;
        }
    }
}

// Ander Bahar End