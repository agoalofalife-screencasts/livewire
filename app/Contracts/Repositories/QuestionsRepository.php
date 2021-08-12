<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

interface QuestionsRepository
{
    public function all(): array;

    public function addQuestion(array $newQuestion);
}
