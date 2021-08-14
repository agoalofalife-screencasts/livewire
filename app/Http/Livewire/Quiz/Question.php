<?php

namespace App\Http\Livewire\Quiz;

use App\Contracts\Repositories\QuestionsRepository;
use Livewire\Component;

class Question extends Component
{
    public string $question;
    public array $options;
    public $answer;
    public $keyCurrentQuestion;
    public $questions;
    public $result;

    public function mount(QuestionsRepository $questionsRepository)
    {
        $this->questions = $questionsRepository->all();
        $this->toggleQuestion();
    }

    public function toggleQuestion()
    {
        $currentQuestion = null;
        foreach ($this->questions as $key => $question) {
            if (!array_key_exists('passed', $question)) {
                $currentQuestion = $question;
                $this->keyCurrentQuestion = $key;
                $this->question = $currentQuestion['question'];
                $this->options = $currentQuestion['options'];
                break;
            }
        }
        if (is_null($currentQuestion)) {
            $this->result = $this->calculateRightAnswers($this->questions);
        }
    }

    public function calculateRightAnswers(array $questions)
    {
        return array_reduce($questions, function ($carry, $question) {
            if ($question['answer_got'] == $question['right_answer']) {
                $carry = $carry + 1;
            }
            return $carry;
        }, 0);
    }
    public function next()
    {
        $this->questions[$this->keyCurrentQuestion] = array_merge($this->questions[$this->keyCurrentQuestion], [
           'passed' => true, 'answer_got' => $this->answer
        ]);
        $this->toggleQuestion();
        $this->reset('answer');
    }

    public function render()
    {
        return view('livewire.quiz.question')->extends('layouts.app');
    }
}
