<?php

namespace App\Http\Livewire\Quiz;

use Livewire\Component;

class Question extends Component
{
    public function render()
    {
        return view('livewire.quiz.question')->extends('layouts.app');
    }
}
