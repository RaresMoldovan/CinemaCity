<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:16
 */

namespace Model\ConsoleManager\Output;

class ErrorReporter
{
    /**
     * @param string $errorMessage
     */
    public function report(string $errorMessage)
    {
        echo "ERROR!" . PHP_EOL . $errorMessage . PHP_EOL;
    }
}