<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 08.08.2018
 * Time: 19:20
 */

namespace Model\ConsoleManager\Importer;

use Model\DataAccess\Repository\HallRepository;
use Model\DataAccess\Repository\SeatRepository;
use Model\Domain\Entity\Seat;
use Model\Domain\Entity\Hall;

class HallImporter
{
    private $csvFormat;
    private $hallRepository;
    private $seatRepository;

    /**
     * HallImporter constructor.
     * @param $csvFormat
     * @param $hallRepository
     * @param $seatRepository
     */
    public function __construct(array $csvFormat, HallRepository $hallRepository, SeatRepository $seatRepository)
    {
        $this->csvFormat      = $csvFormat;
        $this->hallRepository = $hallRepository;
        $this->seatRepository = $seatRepository;
    }

    /**
     * @throws \Exception
     */
    public function import()
    {
        foreach ($this->csvFormat as $record) {
            $record[2] = trim($record[2]);
            $seatCodes = explode(' ', $record[2]);
            $hall      = new Hall((int)$record[0], $record[1], count($seatCodes));
            var_dump($hall);
            $this->hallRepository->insertHardCodedId($hall);
            foreach ($seatCodes as $idAndCode) {
                $this->importSeat($hall, $idAndCode);
            }
        }

    }

    /**
     * @param Hall $hall
     * @param string $idAndCode
     * @throws \Exception
     */
    private function importSeat(Hall $hall, string $idAndCode): void
    {
        $split = explode(':', $idAndCode);
        if (count($split) !== 2) {
            throw new \Exception('Wrong seat format');
        }
        $this->seatRepository->insertHardCodedId(new Seat((int)$split[0], $hall, $split[1]));
    }
}