<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentThesisInfo extends Component
{
    public $avatar,
        $nim,
        $name,
        $studyProgramName,
        $researchTitle,
        $scienceFieldName,
        $firstSupervisor,
        $secondSupervisor;

    /**
     * Create a new component instance.
     *
     * @param $avatar
     * @param $nim
     * @param $name
     * @param $studyProgramName
     * @param $researchTitle
     * @param $scienceFieldName
     * @param $firstSupervisor
     * @param $secondSupervisor
     */
    public function __construct($avatar, $nim, $name, $studyProgramName, $researchTitle, $scienceFieldName, $firstSupervisor, $secondSupervisor)
    {
        $this->avatar = $avatar;
        $this->nim = $nim;
        $this->name = $name;
        $this->studyProgramName = $studyProgramName;
        $this->researchTitle = $researchTitle;
        $this->scienceFieldName = $scienceFieldName;
        $this->firstSupervisor = $firstSupervisor;
        $this->secondSupervisor = $secondSupervisor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-thesis-info');
    }
}
