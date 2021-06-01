<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputRadio extends Component
{
    public $name, $label, $value, $checked;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param $value
     * @param bool $isChecked
     * @param string $checked
     */
    public function __construct($name, $label, $value, $checked = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-radio');
    }
}
