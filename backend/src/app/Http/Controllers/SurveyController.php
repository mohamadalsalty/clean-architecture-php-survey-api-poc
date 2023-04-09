<?php

namespace App\Http\Controllers;

use App\UseCases\SurveyUseCase;
use JetBrains\PhpStorm\NoReturn;

/**
 *
 */
class SurveyController
{
    /**
     * @var SurveyUseCase
     */
    private SurveyUseCase $surveyUseCase;

    /**
     * @param SurveyUseCase $surveyUseCase
     */
    public function __construct(SurveyUseCase $surveyUseCase)
    {
        $this->surveyUseCase = $surveyUseCase;
    }

    /**
     * @param string $title
     * @return void
     */
    public function createSurvey(string $title): void
    {
        $survey = $this->surveyUseCase->create($title);
        $response = [
            'id' => $survey->getId(),
            'title' => $survey->getTitle(),
        ];
        echo json_encode($response);
    }

    /**
     * @param string $id
     * @return void
     */
    public function findSurvey(string $id): void
    {
        $survey = $this->surveyUseCase->find($id);

        if ($survey) {
            $response = [
                'id' => $survey->getId(),
                'title' => $survey->getTitle(),
            ];
        } else {
            http_response_code(404);
            $response = [
                'error' => 'Survey not found with ID: ' . $id,
            ];
        }

        echo json_encode($response);
    }


    /**
     * @return void
     */
    public function findAllSurveys(): void
    {
        $surveys = $this->surveyUseCase->findAll();

        $response = [];

        foreach ($surveys as $survey) {
            $response[] = [
                'id' => $survey->getId(),
                'title' => $survey->getTitle(),
            ];
        }

        echo json_encode($response);
    }
}
