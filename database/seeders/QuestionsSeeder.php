<?php

namespace Database\Seeders;

use App\Contracts\Repositories\QuestionsRepository;
use App\DTO\Quiz\QuestionDto;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    private array $questions = [
        [
            'question' => 'Какая площадь Российской Федерации?',
            'options' => [
                '17 098 246 км²',
                '18 400 222 км²',
                '13 200 000 км²',
                '12 000 232 км²'
            ],
            'right_answer' => 1
        ],
        [
            'question' => 'Какое население России?',
            'options' => [
                '145 975 300',
                '120 175 200',
                '111 900 123',
                '149 345 500'
            ],
            'right_answer' => 0
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @param QuestionsRepository $questionsRepository
     * @return void
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function run(QuestionsRepository $questionsRepository)
    {
        foreach ($this->questions as $question) {
            $questionsRepository->addQuestion(new QuestionDto($question));
        }
    }
}
