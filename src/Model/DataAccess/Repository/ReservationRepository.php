<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;


use Model\DataAccess\Mapper\ReservationMapper;
use Model\Domain\Collection\EntityCollection;
use Model\Domain\Entity\Show;

class ReservationRepository extends EntityRepository
{
    private $showRepository;
    private $userRepository;
    private $hallRepository;
    private $seatRepository;

    /**
     * ReservationRepository constructor.
     * @param \PDO $connection
     * @param HallRepository $hallRepository
     * @param ShowRepository $showRepository
     * @param UserRepository $userRepository
     * @param SeatRepository $seatRepository
     */
    public function __construct(\PDO $connection, HallRepository $hallRepository, ShowRepository $showRepository, UserRepository $userRepository, SeatRepository $seatRepository)
    {
        $this->showRepository = $showRepository;
        $this->userRepository = $userRepository;
        $this->hallRepository = $hallRepository;
        $this->seatRepository = $seatRepository;
        $this->tableName      = 'reservation';
        parent::__construct($connection);
        $this->entityMapper = new ReservationMapper($userRepository, $showRepository, $seatRepository);
    }

    /**
     * @param Show $show
     * @return int
     */
    public function getRemainingNumberOfSeatsForShow(Show $show): int
    {
        $nrOfSeats     = $this->hallRepository->getById($show->getHall()->getId())->getNrOfPlaces();
        $reservedSeats = $this->findByColumn('show_id', $show->getId());
        return $nrOfSeats - count($reservedSeats);
    }

    /**
     * @param int $userId
     * @param int $showId
     * @param int $seatId
     */
    public function insertReservationWithIdNames(int $userId, int $showId, int $seatId): void
    {
        $insertString = "INSERT INTO " . $this->tableName . "(user_id, show_id, seat_id) VALUES (:userId, :showId, :seatId)";
        $statement    = $this->connection->prepare($insertString);
        $statement->bindValue('userId', $userId);
        $statement->bindValue('showId', $showId);
        $statement->bindValue('seatId', $seatId);
        $statement->execute();
    }

}