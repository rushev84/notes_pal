<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NoteComponent extends Component
{
    public $note;
    /**
     * Create a new component instance.
     */
    public function __construct($note)
    {
        $this->note = $note;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.note-component');
    }
}
