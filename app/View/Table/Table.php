<?php


namespace App\View\Table;


use App\View\Components\BooleanView;

class Table
{
    private $paginator;
    private $columns = [];
    private string $title;

    public function __construct()
    {

    }

    public static function create($paginator): Table{
        return (new (__CLASS__))->setPaginator($paginator);
    }

    public function render(){
        return view('table.index', [
            'paginator' => $this->paginator,
            'columns' => $this->columns
        ])->render();
    }

    public function addColumn($attribute, $body = null, $head = null): Table{
        $this->columns[] = [
            'attribute' => $attribute,
            'body' => $body ?? fn($a) => $a,
            'head' => $head ?? fn($a) => strtoupper($a[0]) . str_replace('_', ' ', substr($a, 1)),
        ];
        return $this;
    }

    public function setTitle(string $title): Table{
        $this->title = $this;
        return $this;
    }

    public function setPaginator($paginator): Table{
        $this->paginator = $paginator;
        return $this;
    }
}
