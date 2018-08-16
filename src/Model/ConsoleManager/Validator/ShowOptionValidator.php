<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 10.08.2018
 * Time: 12:02
 */

namespace Model\ConsoleManager\Validator;

class ShowOptionValidator
{
    private $mandatoryOptions;

    /**
     * OptionValidator constructor.
     * @param $mandatoryOptions
     */
    public function __construct($mandatoryOptions)
    {
        $this->mandatoryOptions = $mandatoryOptions;
    }

    public function validateArguments(): string
    {
        $errorMessage = '';

        if (!isset($this->mandatoryOptions['day'])) {
            return 'Day argument not found!';
        }
        $day = $this->mandatoryOptions['day'];
        if (!isset($this->mandatoryOptions['month'])) {
            return 'Month argument not found!';
        }
        $month = $this->mandatoryOptions['month'];
        if (!isset($this->mandatoryOptions['year'])) {
            return 'Year argument not found!';
        }
        $year = $this->mandatoryOptions['year'];
        if (!isset($this->mandatoryOptions['hour'])) {
            return 'Hour argument not found!';
        }
        $hour = $this->mandatoryOptions['hour'];
        if (!isset($this->mandatoryOptions['minute'])) {
            return 'Minute argument not found!';
        }
        if (!isset($this->mandatoryOptions['movie'])) {
            return 'Movie argument not found!';
        }
        if (!isset($this->mandatoryOptions['hall'])) {
            return 'Hall argument not found!';
        }
        $minute = $this->mandatoryOptions['minute'];


        if (!is_numeric($day) || $day > 31) {
            $errorMessage .= 'Day is not numeric or exceeds 31' . PHP_EOL;
        }
        if (!is_numeric($month) || $month > 12) {
            $errorMessage .= 'Month is not numeric or exceeds 12' . PHP_EOL;
        }
        if (!is_numeric($year) || $year < 1000 || $year > 9999) {
            $errorMessage .= 'Year is not numeric or does not have 4 digits' . PHP_EOL;
        }
        if (!is_numeric($hour) || $hour < 0 || $hour > 23) {
            $errorMessage .= 'Hour is not numeric or does not comply to standard 0-24' . PHP_EOL;
        }
        if (!is_numeric($minute) || $minute < 0 || $minute > 59) {
            $errorMessage .= 'Minute is not numeric or does not comply to standard 0-60' . PHP_EOL;
        }
        return $errorMessage;
    }

}