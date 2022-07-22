<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $link,$class,$name,$counter;
    /**
     *
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link,$class,$name,$counter="")
    {
        $this->link = $link;
        $this->class = $class;
        $this->name = $name;
        $this->counter = $counter;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
