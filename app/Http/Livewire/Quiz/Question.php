<?php

namespace App\Http\Livewire\Quiz;

use App\Contracts\Repositories\QuestionsRepository;
use Livewire\Component;

class Question extends Component
{
    public string $question;
    public array $options;
    public $answer;

    public function mount(QuestionsRepository $questionsRepository)
    {
        $questions = $questionsRepository->all();
        $this->question = $questions[0]['question'];
        $this->options = $questions[0]['options'];
    }
    public function render()
    {
        return view('livewire.quiz.question')->extends('layouts.app');
    }
}
