<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:50
 */

namespace Model\DataAccess\Mapper;

use Model\DataAccess\Repository\SeatRepository;
use Model\DataAccess\Repository\ShowRepository;
use Model\DataAccess\Repository\UserRepository;
use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Reservation;
use Model\Domain\Entity\NullEntity;

class ReservationMapper extends EntityMapper
{
    const FIELD_SHOW = 'show_id';
    const FIELD_SEAT = 'seat_id';
    const FIELD_USER = 'user_id';

    private $userRepository;
    private $showRepository;
    private $seatRepository;

    /**
     * ReservationMapper constructor.
     * @param $userRepository
     * @param $showRepository
     * @param $seatRepository
     */
    public function __construct(UserRepository $userRepository, ShowRepository $showRepository, SeatRepository $seatRepository)
    {
        $this->userRepository = $userRepository;
        $this->showRepository = $showRepository;
        $this->seatRepository = $seatRepository;
    }

    /**
     * @param array $associative
     * @return Entity
     */
    public function map(array $associative): Entity
    {
        $id     = $associative[parent::FIELD_ID];
        $showId = $associative[self::FIELD_SHOW];
        $seatId = $associative[self::FIELD_SEAT];
        $userId = $associative[self::FIELD_USER];
        //Id to actual object mapping
        $show = $this->showRepository->getById($showId);
        $seat = $this->seatRepository->getById($seatId);
        $user = $this->userRepository->getById($userId);
        return new Reservation($id, $user, $show, $seat);
    }

}