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
        $this->fileName  = $fileName;
        $this->separator = $separator;
        $this->content   = [];
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getContent(): array
    {
        if (count($this->content) === 0) {
            $this->content = $this->readCSV();
        }
        return $this->content;
    }

    /**
     * @return array|bool
     * @throws \Exception
     */
    private function readCSV(): array
    {

        $lines  = array();
        $handle = fopen($this->fileName, "r");
        if ($handle != false) {
            $line        = fgetcsv($handle, 0, $this->separator);
            $nrOfEntries = count($line);
            while (($line = fgetcsv($handle, 0, $this->separator)) !== false) {
                if (count($line) !== $nrOfEntries) {
                    throw new \Exception('CSV file is not consistent in row data!');
                }
                $lines[] = $line;
            }
            fclose($handle);
            return $lines;
        }
        return [];
    }

}