<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BooleanView extends Component
{
    public bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return view('components.boolean-view');
    }
}
