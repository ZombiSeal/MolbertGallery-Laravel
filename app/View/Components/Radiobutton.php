<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Radiobutton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $item;
    public $name;
    public function __construct($item, $name)
    {
        $this->item=$item;
        $this->name=$name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radiobutton');
    }
}
