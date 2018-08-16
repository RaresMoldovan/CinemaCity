<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\MovieMapper;
use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Movie;

class MovieRepository extends EntityRepository
{

    const RECORDS_PER_PAGE = 4;

    /**
     * MovieRepository constructor.
     * @param \PDO $connection
     * @param GenreRepository $genreRepository
     */
    public function __construct(\PDO $connection, GenreRepository $genreRepository)
    {
        $this->tableName = 'movie';
        parent::__construct($connection);
        $this->entityMapper = new MovieMapper($genreRepository);
    }

    /**
     * @param Entity $entity
     */
    public function insert(Entity $entity): void
    {
        parent::insert($entity);
        $this->attachGenres($entity);
    }

    /**
     * @param Entity $entity
     */
    public function insertHardCodedId(Entity $entity): void
    {
        parent::insertHardCodedId($entity);
        $this->attachGenres($entity);
    }

    /**
     * @param Entity $entity
     */
    private function attachGenres(Entity $entity)
    {
        //Delete all previous genre mentions
        $deleteQueryString = "DELETE FROM movie_to_genre WHERE movie_id=:movie";
        $deleteStatement   = $this->connection->prepare($deleteQueryString);
        $deleteStatement->bindValue("movie", $entity->getId(), \PDO::PARAM_INT);
        $deleteStatement->execute();
        //Insert genres
        $genreCollection = $entity->getGenres();
        $queryString     = "INSERT INTO movie_to_genre (movie_id, genre_id) VALUES (:movie, :genre)";
        $statement       = $this->connection->prepare($queryString);
        $movieId         = $entity->getId();
        $statement->bindValue("movie", $movieId, \PDO::PARAM_INT);
        foreach ($genreCollection as $genre) {
            $statement->bindValue("genre", $genre->getId(), \PDO::PARAM_INT);
            $statement->execute();
        }
    }

    /**
     * Returns the movie which comply with the given criteria: selected genre, year, date, sorting option and page number.
     * @param string $pageNumber
     * @param string $genre
     * @param string $year
     * @param string $date
     * @param string $sorted
     * @return array Of type [count(total number of records), limited records from offset]
     */
    public function getFilteredMovies(string $pageNumber, string $genre, string $year, string $date, string $sorted): array
    {
        $genreQuery = '';
        $yearQuery  = '';
        $sortQuery  = '';
        $dateQuery  = 'id in (select movie_id from `show` where time>now())';

        $limit = self::RECORDS_PER_PAGE;
        //Set page number to 1 if no page provided
        if ($pageNumber === '') {
            $pageNumber = '1';
        }
        $offset = ($pageNumber - 1) * $limit;

        $bindGenre = false;
        if ($genre !== '0' && $genre !== '') {
            $genreQuery = "id IN (SELECT movie_id FROM movie_to_genre WHERE genre_id=:genreId)";
            $bindGenre  = true;
        }
        $bindYear = false;
        if ($year !== 'All' && $year != '') {
            $yearQuery = " year=:year";
            $bindYear  = true;
        }
        if ($sorted !== '') {
            $sortQuery = "ORDER BY year " . $sorted;
        }

        $bindDate = false;
        if ($date !== '') {
            $bindDate  = true;
            $dateQuery = 'id in (select movie_id from `show` where day(time)=:dateDay AND month(time)=:dateMonth AND year(time)=:dateYear)';
        }

        $conditionArray = [$dateQuery, $genreQuery, $yearQuery];

        //We execute in parallel 2 queries, one which counts the entire number of records(in order to predict number of pages)
        //and one which selects only from a given offset, a fixed number of records
        $conditionString = $this->implodeQueryConditions($conditionArray);


        $finalQuery     = "SELECT * FROM movie WHERE " . $conditionString . ' ' . $sortQuery . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        $countQuery     = "SELECT count(*) AS total FROM movie WHERE " . $conditionString;
        $statement      = $this->connection->prepare($finalQuery);
        $countStatement = $this->connection->prepare($countQuery);
        if ($bindGenre) {
            $statement->bindValue('genreId', $genre, \PDO::PARAM_INT);
            $countStatement->bindValue('genreId', $genre, \PDO::PARAM_INT);
        }
        if ($bindYear) {
            $statement->bindValue('year', $year, \PDO::PARAM_INT);
            $countStatement->bindValue('year', $year, \PDO::PARAM_INT);
        }
        if ($bindDate) {
            $dateArray = [];
            preg_match_all('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $dateArray, PREG_SET_ORDER, 0);
            $statement->bindValue('dateDay', $dateArray[0][3], \PDO::PARAM_INT);
            $countStatement->bindValue('dateDay', $dateArray[0][3], \PDO::PARAM_INT);
            $statement->bindValue('dateMonth', $dateArray[0][2], \PDO::PARAM_INT);
            $countStatement->bindValue('dateMonth', $dateArray[0][2], \PDO::PARAM_INT);
            $statement->bindValue('dateYear', $dateArray[0][1], \PDO::PARAM_INT);
            $countStatement->bindValue('dateYear', $dateArray[0][1], \PDO::PARAM_INT);
        }
        $countStatement->execute();
        $statement->execute();
        $result = $statement->fetchAll();
        return [$countStatement->fetch()['total'], $this->entityMapper->mapAll($result)];

    }

    /**
     * @param array $queryConditions
     * @return mixed|string
     */
    private function implodeQueryConditions(array $queryConditions)
    {
        //Add date query string
        $conditionString = $queryConditions[0];

        array_shift($queryConditions);
        foreach ($queryConditions as $queryCondition) {
            if ($queryCondition !== '') {
                $conditionString .= ' AND ' . $queryCondition;
            }
        }
        return $conditionString;
    }
}