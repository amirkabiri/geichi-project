<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaginationLinks extends Component
{
    public $paginator;
    public string $justify = 'center';

    public function __construct($paginator, $justify = 'center')
    {
        $this->paginator = $paginator;
        $this->justify = $justify;
    }

    public function render()
    {
        return view('components.pagination-links');
    }
}
