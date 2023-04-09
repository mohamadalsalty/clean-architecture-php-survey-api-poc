<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\SurveyEntity;
use App\Domain\Repositories\SurveyRepositoryInterface;
use App\Infrastructure\Database\MysqlConnection;

/**
 *
 */
class MysqlSurveyRepository implements SurveyRepositoryInterface
{
    /**
     * @var \PDO
     */
    private \PDO $connection;

    /**
     *
     */
    public function __construct()
    {
        $this->connection = MysqlConnection::connect();
    }

    /**
     * @param SurveyEntity $surveyEntity
     * @return SurveyEntity
     */
    public function create(SurveyEntity $surveyEntity): SurveyEntity
    {
        $stmt = $this->connection->prepare("INSERT INTO surveys (title) VALUES (:title)");
        $stmt->execute([':title' => $surveyEntity->getTitle()]);

        return new SurveyEntity($this->connection->lastInsertId(), $surveyEntity->getTitle());
    }

    /**
     * @param string $id
     * @return SurveyEntity|null
     */
    public function find(string $id): ?SurveyEntity
    {
        $stmt = $this->connection->prepare("SELECT * FROM surveys WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $survey = $stmt->fetch();

        if (!$survey) {
            return null;
        }

        return new SurveyEntity($survey['id'], $survey['title']);
    }


    /**
     * @return array
     */
    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM surveys");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $surveys = [];
        foreach ($result as $row) {
            $survey = new SurveyEntity($row['id'], $row['title']);
            $surveys[] = $survey;
        }

        return $surveys;
    }

}
