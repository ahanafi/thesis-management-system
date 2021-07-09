<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentWidgetTiles extends Component
{
    public $background, $link, $icon, $text, $textColor;
    public $isDone;

    /**
     * Create a new component instance.
     *
     * @param $background
     * @param $link
     * @param $icon
     * @param $text
     */
    public function __construct($background, $link, $icon, $text, $textColor, $isDone = false)
    {
        $this->background = $background;
        $this->link = $link;
        $this->icon = $icon;
        $this->text = $text;
        $this->textColor = $textColor;
        $this->isDone = $isDone;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-widget-tiles');
    }
}
