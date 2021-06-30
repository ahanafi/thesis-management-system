<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentInfo extends Component
{
    public $name, $nim, $studyProgramName, $semester;
    public $avatar;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $nim
     * @param $studyProgramName
     * @param $semester
     * @param null $avatar
     */
    public function __construct($name, $nim, $studyProgramName, $semester, $avatar = null)
    {
        $this->name = $name;
        $this->nim = $nim;
        $this->studyProgramName = $studyProgramName;
        $this->semester = $semester;
        $this->avatar = $avatar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-info');
    }
}
