<?php

namespace App\Domain\Entities;

/**
 *
 */
class SurveyEntity
{

    /**
     * @var string
     */
    private string $title;
    /**
     * @var string|null
     */
    private ?string $id;

    /**
     * @param $id
     * @param $title
     */
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
