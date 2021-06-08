<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLink extends Component
{
    public $text, $type, $link;
    public $icon, $extendClass;

    /**
     * Create a new component instance.
     *
     * @param string $link
     * @param $text
     * @param $type
     * @param string $icon
     * @param string $extendClass
     */
    public function __construct($link = '#', $text, $type, $icon = '', $extendClass = '')
    {
        $this->type = $type;
        $this->link = $link;
        $this->text = $text;
        $this->icon = $icon;
        $this->extendClass = $extendClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-link');
    }
}
