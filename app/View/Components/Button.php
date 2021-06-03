<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $name, $type, $text, $btnType;
    public $isLink, $link;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type, $isLink = false, $link = '', $text, $btnType)
    {
        $this->name = $name;
        $this->type = $type;
        $this->isLink = $isLink;
        $this->link = $link;
        $this->text = $text;
        $this->btnType = $btnType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
