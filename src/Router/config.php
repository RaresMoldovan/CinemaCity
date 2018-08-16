<?php

return [
    serialize(['/','GET']) => ['Controller\MovieController', 'getHomePage'],
    serialize(['/users/logIn', 'GET']) => ['Controller\UserController', 'getLogInPage'],
    serialize(['/users/logIn', 'POST'])=> ['Controller\UserController', 'handleLogIn'],
    serialize(['/users/logOut', 'GET'])=> ['Controller\UserController', 'handleLogOut'],
    serialize(['/users/register', 'GET']) => ['Controller\UserController', 'getRegisterPage'],
    serialize(['/users/register', 'POST']) => ['Controller\UserController', 'handleRegister'],
    serialize(['/movies', 'GET']) => ['Controller\MovieController', 'getMoviesPage'],
    serialize(['/movies/\d*','GET']) => ['Controller\MovieController', 'getMoviePage'],
    serialize(['/shows/seats/\d*', 'GET']) => ['Controller\ShowController', 'getNumberOfRemainingSeats'],
    serialize(['/shows/\d*', 'GET']) => ['Controller\ReservationController', 'getShowPage'],
    serialize(['/shows/\d*', 'POST']) => ['Controller\ReservationController', 'book']
];