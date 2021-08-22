<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{
    public $title;
    public $message;

    /**
     * @var bool
     */
    public $show = false;

    protected $listeners = ['quizPassed'];

    public function quizPassed(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
        $this->show = true;
    }
    public function render()
    {
        return view('livewire.toast');
    }
}
