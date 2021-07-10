<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LeaderWidgetTiles extends Component
{
    public $background, $link, $icon, $textColor, $dataCount, $dataName;

    /**
     * Create a new component instance.
     *
     * @param $background
     * @param $link
     * @param $icon
     * @param $textColor
     * @param $dataCount
     * @param $dataName
     */
    public function __construct($background, $link, $icon, $textColor, $dataCount, $dataName)
    {
        $this->background = $background;
        $this->link = $link;
        $this->icon = $icon;
        $this->textColor = $textColor;
        $this->dataCount = $dataCount;
        $this->dataName = $dataName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.leader-widget-tiles');
    }
}
