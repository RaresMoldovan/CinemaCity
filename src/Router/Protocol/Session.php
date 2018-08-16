<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 15.08.2018
 * Time: 14:00
 */

namespace Router\Protocol;


class Session
{

    public function startSession()
    {
        session_start();
    }

    public function setSessionVariable(string $key, string $value) : void
    {
        $_SESSION[$key] = $value;
    }

    public function getSessionVariable(string $key)  : string
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : '');
    }

    public function unsetSessionVariable(string $key) : void
    {
        unset($_SESSION[$key]);
    }

    public function getSessionDetails()
    {
        return $_SESSION;
    }

    public function endSession()
    {
        session_destroy();
    }
}