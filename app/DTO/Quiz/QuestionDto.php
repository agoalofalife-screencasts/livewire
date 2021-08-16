<?php
declare(strict_types=1);

namespace App\DTO\Quiz;

use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class QuestionDto extends DataTransferObject
{
    public string $question;
    public array $options;

    #[NumberBetween(0, 4)]
    public string $right_answer;
}
