<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\SurveyEntity;

/**
 *
 */
interface SurveyRepositoryInterface
{
    /**
     * @param SurveyEntity $surveyEntity
     * @return SurveyEntity
     */
    public function create(SurveyEntity $surveyEntity): SurveyEntity;

    /**
     * @param string $id
     * @return SurveyEntity|null
     */
    public function find(string $id): ?SurveyEntity;
}
