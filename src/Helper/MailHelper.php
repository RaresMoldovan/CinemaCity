<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 16.08.2018
 * Time: 13:47
 */

namespace Helper;

use Model\Domain\Entity\Show;
use Model\Domain\Entity\Seat;

class MailHelper
{
    /**
     * @param string $movieName
     * @param string $date
     * @param string $seatCode
     * @param string $user
     */
    public function sendReservationMail(string $movieName, string $date, string $seatCode, string $user)
    {
        $header  = "From: Cinema Reservation System <testcinema31@gmail.com>\r\n";
        $subject = "Reservation details";
        $message = "Your reservation has been registered!" . PHP_EOL . "Show: " . $movieName .
                   " on " . $date . PHP_EOL . "Seat: " . $seatCode;
        mail($user, $subject, $message, $header);
    }
}