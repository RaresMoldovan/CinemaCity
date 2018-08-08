<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 18:24
 */

namespace Model\ConsoleManager\Input;

class CSVReader
{
    private $fileName;
    private $separator;
    private $content;

    /**
     * CSVReader constructor.
     * @param $fileName string
     * @param $separator string
     */
    public function __construct(string $fileName, string $separator)
    {
        $this->fileName = $fileName;
        $this->separator = $separator;
        $this->content = [];
    }

    /**
     * @return array
     */
    public function getContent() : array
    {
        if(count($this->content)===0) {
            $this->content = $this->readCSV();
        }
        return $this->content;
    }

    /**
     * @return array|bool
     */
    private function readCSV() : array
    {
        $lines  = array();
        $handle = fopen($this->fileName, "r");
        if ($handle != false) {;
            while (($line = fgetcsv($handle, 0, $this->separator)) !== false) {
                $this->content[] = $line;
            }
            fclose($handle);
            return $lines;
        }
        return [];
    }

}