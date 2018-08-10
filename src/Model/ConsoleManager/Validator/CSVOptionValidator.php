<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 10.08.2018
 * Time: 12:01
 */

namespace Model\ConsoleManager\Validator;


class CSVOptionValidator
{
    public function validateFileName(string $fileName) : string
    {
        if(!file_exists($fileName)) {
            return 'File not found!';
        }
        return '';
    }
}