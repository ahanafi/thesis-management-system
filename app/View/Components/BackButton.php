<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BackButton extends Component
{
    public $type, $size, $link;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $link
     * @param $size
     */
    public function __construct($type,$link, $size = '')
    {
        $this->type = $type;
        $this->size = $size;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.back-button');
    }
}
