<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $title;
    public $items;
    public  $name;
    public  $type;
    public function __construct($title, $name, $items, $type)
    {
        $this->title=$title;
        $this->name = $name;
        $this->items = $items;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter-item');
    }
}
