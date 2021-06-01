<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label, $field, $type, $placeholder, $value;
    public $isRequired, $isReadOnly;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param $field
     * @param $type
     * @param string $placeholder
     * @param string $value
     * @param bool $isRequired
     * @param bool $isReadOnly
     */
    public function __construct($label = "", $field, $type, $placeholder = '', $value = '', $isRequired = false, $isReadOnly = false)
    {
        $this->label = $label;
        $this->field = $field;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->isRequired = $isRequired;
        $this->isReadOnly = $isReadOnly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
