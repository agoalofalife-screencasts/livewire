<?php

namespace App\Http\Livewire\Quiz;

use App\Contracts\Repositories\QuestionsRepository;
use App\DTO\Quiz\QuestionDto;
use Livewire\Component;

class CreateQuestion extends Component
{
    public $question;
    public $options = [];
    public $right_answer;

    protected $rules = [
        'question' => 'required',
        'options' => ['required', 'array', 'min:4', 'max:5'],
        'options.*' => ['required', 'string', 'distinct'],
        'right_answer' => 'required'
    ];

    protected $messages = [
        'question.required' => 'Вопрос обязателен для заполнения',
        'options.*.distinct' => 'Варианты ответов не должны совпадать'
    ];

    public function updated($propertyName)
    {
        if (preg_match('/options\.[0-9]/', $propertyName)) {
            $this->validateOnly($propertyName);
        }
    }

    public function addEmptyOption()
    {
        $this->options[] = null;
    }
    public function saveQuestion(QuestionsRepository $questionsRepository)
    {
        $validatedData = $this->validate();
        $questionsRepository->addQuestion(new QuestionDto($validatedData));
        session()->flash('message', 'Вопрос успешно добавлен!');

        $this->reset(['question', 'options', 'right_answer']);
    }
    public function render()
    {
        return view('livewire.quiz.create-question');
    }
}
