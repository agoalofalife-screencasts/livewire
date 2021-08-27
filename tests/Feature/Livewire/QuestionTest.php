<?php

namespace Tests\Feature\Livewire;

use App\Contracts\Repositories\QuestionsRepository;
use App\Http\Livewire\Quiz\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use WithFaker;

    public function test_get_current_result(): void
    {
        $fakeQuestions = $this->fakeQuestions();
        $this->instance(
            QuestionsRepository::class,
            \Mockery::mock(QuestionsRepository::class, fn (
                MockInterface $mock
            ) => $mock->shouldReceive('all')->once()->andReturn($fakeQuestions))
        );

        Livewire::test(Question::class)
                  ->call('loadQuestion')
                  ->call('getCurrentResult')
                  ->assertSee(sprintf('Всего %s из %s', 0, count($fakeQuestions)));
            // Всего 0 из 2
    }

    public function test_get_result(): void
    {
        $fakeQuestions = $this->fakeQuestions(1);
        $this->instance(
            QuestionsRepository::class,
            \Mockery::mock(QuestionsRepository::class, fn (
                MockInterface $mock
            ) => $mock->shouldReceive('all')->once()->andReturn($fakeQuestions))
        );
        Livewire::test(Question::class)
            ->call('loadQuestion')
            ->set('answer', 1)
            ->call('next')
            ->assertViewHas('answer', null)
            ->assertDispatchedBrowserEvent('toast', ['title' => 'Уведомление', 'message' => 'Тест пройден'])
//            ->assertEmitted('toast')
            ->assertViewIs('livewire.quiz.question')
            ->assertSee('Всего правильных ответов')
            ->assertSee('Всего вопросов ' . count($fakeQuestions));
//            ->assertSeeInOrder(['Всего правильных ответов', 'Всего вопросов ' . count($fakeQuestions)])

    }
    public function fakeQuestions(int $maxQuestions = 5): array
    {
        $questions = [];
        for ($i = 0; $i < $maxQuestions; $i++) {
            $questions[] = [
                'question' => $this->faker->word,
                'options' => [
                    $this->faker->word,
                    $this->faker->word,
                    $this->faker->word,
                    $this->faker->word,
                ],
                'right_answer' => $this->faker->numberBetween(0, 3)
            ];
        }
        return $questions;
    }
}
