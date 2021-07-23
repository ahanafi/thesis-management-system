<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LecturerWidgetTiles extends Component
{
    public $title, $count, $background, $icon;

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $count
     * @param $background
     * @param $icon
     */
    public function __construct($title, $count, $background, $icon)
    {
        $this->title = $title;
        $this->count = $count;
        $this->background = $background;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer-widget-tiles');
    }
}
