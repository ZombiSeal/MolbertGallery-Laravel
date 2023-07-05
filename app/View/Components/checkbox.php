<?php

namespace App\View\Components;

use Illuminate\View\Component;

class checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $item;
    public $type;
    public function __construct($name, $item, $type)
    {
        $this->name=$name;
        $this->type=$type;
        $this->item=$item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
