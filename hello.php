<?php

require './vendor/autoload.php';

use Classes\User;
use Classes\Comment;


$invalidUsers = [
    new User(-1, 'MilkyWay0', 'milkway@gmail.com', '$0m3_Pa$$w0rd'),
    new User(1, '', 'milkw@gmail.com', 'Lalalala%#@lala'),
    new User(2, 'mwmwmwmwmwmwmwmwmwmwmwmwmwmwmwmwmwm2', 'milkww@gmail.com', 'dkngd%@rtnguinrdbv23t45'),
    new User(3, 'MilkyWay3', '', 'ertrgh#%$546ytuh7j#$%nugp'),
    new User(4, 'MilkyWay4', 'milkgmail.com', '34e5t6r#$%'),
    new User(5, 'MilkyWay5', 'mi', '5467yu8rt56u$34#$%'),
    new User(6, 'MilkyWay6', 'milkmilkmilkmilkmilkmilkmilkmilkmilk@gmail.com', 'ert6hyfgjumbn'),
    new User(7, 'MilkyWay7', 'milk234@gmail.com', ''),
    new User(8, 'MilkyWay8', 'mi1k@gmail.com', '$w0rd'),
    new User(9, 'MilkyWay9', 'mil32k@gmail.com', '$0m3_Pa$$w0rd$0m3_Pa$$w0rd$0m3_Pa$$w0rd$0m3_Pa$$w0rd'),
];

foreach($invalidUsers as $invalidUser) {
    $invalidUser->showInfo();
}

$validUsers = [
    new User(11, 'Bober1', 'cow1@gmail.com', '$Tr0nG__pA$sw0Rd'),
    new User(12, 'Bober2', 'cow2@gmail.com', '$Tr0nG__pA$sw0Rd'),
    new User(13, 'Bober3', 'cow3@gmail.com', '$Tr0nG__pA$sw0Rd'),
];

$comments = [
    new Comment($validUsers[0], '1st comment'),
    new Comment($validUsers[1], '2nd comment'),
    new Comment($validUsers[2], '3rd comment'),
    new Comment($validUsers[0], '4th comment'),
    new Comment($validUsers[1], '5th comment'),
    new Comment($validUsers[2], '6th comment'),
    new Comment($validUsers[0], '7th comment'),
];

foreach($comments as $comment) {
    if ($comment->getPublicationDateTime() > $comments[3]->getPublicationDateTime()) {
        $comment->showInfo();
    }
}
