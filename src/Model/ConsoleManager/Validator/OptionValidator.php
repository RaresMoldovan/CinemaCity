<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:22
 */

namespace Model\ConsoleManager\Validator;

class OptionValidator
{
    private $mandatoryOptions;
    private $movieRepository;
    private $hallRepository;
    private  $showRepository;

    /**
     * OptionValidator constructor.
     * @param $mandatoryOptions
     */
    public function __construct($mandatoryOptions)
    {
        $this->mandatoryOptions = $mandatoryOptions;
    }

    public function validateDate() : string
    {
        $errorMessage = '';
        $day = $this->mandatoryOptions['date'];
        $month = $this->mandatoryOptions['month'];
        $year = $this->mandatoryOptions['year'];
        $hour = $this->mandatoryOptions['hour'];
        $minute = $this->mandatoryOptions['minute'];
        if(!is_numeric($day) || $day>31) {
            $errorMessage .= 'Day is not numeric or exceeds 31' .PHP_EOL;
        }
        if(!is_numeric($day) || $month>12) {
            $errorMessage .= 'Month is not numeric or exceeds 12' .PHP_EOL;
        }
        if(!is_numeric($year)|| $year<1000||$year>9999) {
            $errorMessage .= 'Year is not numeric or does not have 4 digits' .PHP_EOL;
        }
        if(!is_numeric($hour)||$hour<0||$hour>23) {
            $errorMessage = 'Hour is not numeric or does not comply to standard 0-24' . PHP_EOL;
        }
        if(!is_numeric($minute)||$minute<0||$minute>59) {
            $errorMessage = 'Hour is not numeric or does not comply to standard 0-24' . PHP_EOL;
        }
        return $errorMessage;
    }

    public function validateFileName(string $fileName) : string
    {
        if(!file_exists($fileName)) {
            return 'File not found!';
        }
        return '';
    }



}