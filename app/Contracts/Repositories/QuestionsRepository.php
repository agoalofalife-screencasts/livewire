<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\DTO\Quiz\QuestionDto;

interface QuestionsRepository
{
    public function all(): array;

    public function addQuestion(QuestionDto $questionDto);
}
