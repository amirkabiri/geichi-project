<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DateTimeView extends Component
{
    public $datetime;

    public function __construct($datetime)
    {
        $this->datetime = toCarbon($datetime);
    }

    public function render()
    {
        return view('components.date-time-view');
    }
}
