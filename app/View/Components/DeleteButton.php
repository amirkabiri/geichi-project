<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    public string $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function render()
    {
        return view('components.delete-button');
    }
}
