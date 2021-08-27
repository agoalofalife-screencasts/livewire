<?php

namespace Tests\Feature\Livewire;

use App\Contracts\Repositories\QuestionsRepository;
use App\Http\Livewire\Quiz\CreateQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateQuestionTest extends TestCase
{
    /**
     * @param $field
     * @param $value
     * @param $rule
     * @dataProvider validationRules
     */
    public function test_validation_rules($field, $value, $rule): void
    {
        $component = Livewire::test(CreateQuestion::class);

        if (preg_match('/\*$/', $field)) {
            foreach ($value as $index => $option) {
                $component->set(str_replace('*', $index, $field), $option);
            }
            $component->call('saveQuestion')
                ->assertHasErrors([str_replace('*', 0, $field) => $rule]);
        } else {
            $component->set($field, $value)
//            ->set('question', null)
                ->call('saveQuestion')
//              ->assertHasErrors(['question' => 'required'])
                ->assertHasErrors([$field => $rule]);
        }


        // ->set('options.0', 'value')
        // ->set('options.1', 'value')
        // ->assertHasErrors(['options.0' => 'distinct'])
    }

    public function test_save_question(): void
    {
        $this->instance(
            QuestionsRepository::class,
            \Mockery::mock(QuestionsRepository::class, fn (
                MockInterface $mock
            ) => $mock->shouldReceive('addQuestion')->once())
        );
        Livewire::test(CreateQuestion::class)
            ->set('question', 'Test')
            ->set('options', ['one', 'two', 'three', 'four'])
            ->set('right_answer', 2)
            ->call('saveQuestion')
            ->assertSee('Вопрос успешно добавлен!');
    }

    public function validationRules(): array
    {
        return [
            'question is null' => ['question', null, 'required'],
            'options is null' => ['options', [], 'required'],
            'right_answer is null' => ['right_answer', null, 'required'],
            'options is very small' => ['options', ['one'], 'min'],
            'options is too much' => ['options', [
                'one', 'two', 'three', 'four', 'five', 'six'
            ], 'max'],
            'options is distinct' => ['options.*', ['one', 'one'], 'distinct']
        ];
    }
}
