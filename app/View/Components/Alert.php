<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $heading, $type, $dismissable, $icon;
    public $message;

    /**
     * Create a new component instance.
     *
     * @param $heading
     * @param $type
     * @param $dismissable
     * @param $icon
     * @param $message
     */
    public function __construct($heading = '', $type, $dismissable = '', $icon, $message)
    {
        $this->heading = $heading;
        $this->type = $type;
        $this->dismissable = $dismissable;
        $this->icon = $icon;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
