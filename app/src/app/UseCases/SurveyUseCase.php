<?php

namespace App\UseCases;

use App\Domain\Entities\SurveyEntity;
use App\Domain\Repositories\SurveyRepositoryInterface;

/**
 *
 */
class SurveyUseCase
{
    /**
     * @var SurveyRepositoryInterface
     */
    private SurveyRepositoryInterface $surveyRepository;

    /**
     * @param SurveyRepositoryInterface $surveyRepository
     */
    public function __construct(SurveyRepositoryInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    /**
     * @param string $title
     * @return SurveyEntity
     */
    public function create(string $title): SurveyEntity
    {
        $surveyEntity = new SurveyEntity(null, $title);
        return $this->surveyRepository->create($surveyEntity);
    }

    /**
     * @param string $id
     * @return SurveyEntity|null
     */
    public function find(string $id): ?SurveyEntity
    {
        return $this->surveyRepository->find($id);
    }
}
