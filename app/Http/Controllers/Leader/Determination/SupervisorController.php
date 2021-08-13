<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Constants\Functional;
use App\Constants\ScoreTag;
use App\Http\Controllers\Controller;
use App\Models\DataSet;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\Thesis;
use App\Services\C45Service;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $theses = Thesis::getDoesNotHaveSupervisor($studyProgram->study_program_code);

        return viewStudyProgramLeader('determination.supervisor.index', compact('theses'));
    }

    public function setSupervisor(Thesis $thesis)
    {
        $thesis->load(['student', 'scienceField']);

        $studyProgramCode = $thesis->student->study_program_code;
        $firstSupervisorCandidates = Lecturer::studyProgramCode($studyProgramCode)
            ->where(function ($query) {
                $query->where('functional', Functional::LECTURER)
                    ->orWhere('functional', Functional::EXPERT_ASSISTANT);
            })
            ->get();
        $lecturers = Lecturer::select('full_name', 'nidn', 'degree')->get();

        return viewStudyProgramLeader('determination.supervisor.single', compact('thesis', 'lecturers', 'firstSupervisorCandidates'));
    }

    public function save(Request $request, Thesis $thesis)
    {
        $this->validate($request, [
            'first_supervisor' => 'required|exists:lecturers,nidn',
            'second_supervisor' => 'required|exists:lecturers,nidn|different:first_supervisor',
        ]);

        $thesis->first_supervisor = $request->get('first_supervisor');
        $thesis->second_supervisor = $request->get('second_supervisor');

        if($thesis->save()) {
            $message = setFlashMessage('success', 'custom', 'Data pembimbing skripsi berhasil ditentukan.');
        } else {
            $message = setFlashMessage('error', 'custom', 'Gagal menyimpan data pembimbing skripsi.');
        }

        return redirect()->route('leader.determination.supervisor.index')->with('message', $message);
    }

    public function lecturerList(Thesis $thesis)
    {
        //Load relations
        $thesis->load(['student', 'scienceField']);

        $filteredLecturers = [];

        // All Lecturers
        $lecturers = Lecturer::with('study_program')
            ->get()
            ->each(function ($lecturer) {
                $lecturer->asFirstSupervisorCount = DataSet::where('first_supervisor', 'LIKE', '%' . $lecturer->getFullName() . '%')->count();
                $lecturer->asSecondSupervisorCount = DataSet::where('second_supervisor', $lecturer->getFullName())->count();
                $lecturer->supervisorType = ($lecturer->asFirstSupervisorCount > $lecturer->asSecondSupervisorCount) ? 1 : 2;
            });

        // Criteria
        $homebases = [];
        $functionalJobs = [];
        $firstSupervisorScores = [];
        $secondSupervisorScores = [];

        $totalFirstSupervisor = 0;
        $totalSecondSupervisor = 0;

        //Filter lecturers
        foreach ($lecturers as $lecturer) {
            if ($lecturer->asFirstSupervisorCount > 0 || $lecturer->asSecondSupervisorCount > 0) {
                $lectureship = ($lecturer->functional !== null) ? getLecturship($lecturer->functional) : 'NON-JAB';

                $firstSupervisorLabel = ScoreTag::getFirstLabel($lecturer->asFirstSupervisorCount);
                $secondSupervisorLabel = ScoreTag::getSecondLabel($lecturer->asSecondSupervisorCount);

                $filteredLecturers[] = (object)[
                    'name' => $lecturer->getShortName(),
                    'homebase' => $lecturer->study_program->getName(),
                    'asFirstSupervisorCount' => $lecturer->asFirstSupervisorCount,
                    'asSecondSupervisorCount' => $lecturer->asSecondSupervisorCount,
                    'firstSupervisorLabel' => $firstSupervisorLabel,
                    'secondSupervisorLabel' => $secondSupervisorLabel,
                    'functional' => $lectureship,
                    'supervisorType' => $lecturer->supervisorType
                ];

                $homebases[] = $lecturer->study_program->getName();
                $functionalJobs[] = $lectureship;
                $firstSupervisorScores[] = $firstSupervisorLabel;
                $secondSupervisorScores[] = $secondSupervisorLabel;

                if($lecturer->asFirstSupervisorCount > 0){
                    $totalFirstSupervisor++;
                } else if ($lecturer->asSecondSupervisorCount > 0){
                    $totalSecondSupervisor++;
                }
            }
        }

        $countFilteredLecturers = count($filteredLecturers);

        //Unique Item
        $uniqueHombase = array_values(array_unique($homebases));
        $uniqueFunctional = array_values(array_unique($functionalJobs));

        /* C45 Calculation Section */
        $entropyTotal = C45Service::calculateEntropy($countFilteredLecturers, $totalFirstSupervisor, $totalSecondSupervisor);

        /*
         * Section for Hombase calculation
         * */
        $homebaseAttributes = [];
        $homebases = [];
        $totalCriteria = 0;
        foreach ($uniqueHombase as $homebase) {
            $totalCriteria = countFromArray($filteredLecturers, ['homebase' => $homebase]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'homebase' => $homebase,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'homebase' => $homebase,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $homebaseAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $homebases[] = [
                'name' => $homebase,
                'total' => $totalCriteria,
                'first_supervisor' => $totalFirstCriteria,
                'second_supervisor' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        /*
         * Section for Functional jobs calculation
         * */
        $functionalJobAttributes = [];
        $functionalJobs = [];
        $totalCriteria = 0;
        foreach ($uniqueFunctional as $functional) {
            $totalCriteria = countFromArray($filteredLecturers, ['functional' => $functional]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'functional' => $functional,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'functional' => $functional,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $functionalJobAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $functionalJobs[] = [
                'name' => $functional,
                'total' => $totalCriteria,
                'first_supervisor' => $totalFirstCriteria,
                'second_supervisor' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        //Labels
        $scoreLabels = ['SANGAT TINGGI', 'TINGGI', 'CUKUP', 'KURANG'];

        /*
         * Section for First Scores
         * */
        $firstSupervisorScoreAttributes = [];
        $firstSupervisorScores = [];
        $totalCriteria = 0;
        foreach ($scoreLabels as $label) {
            $totalCriteria = countFromArray($filteredLecturers, ['firstSupervisorLabel' => $label]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'firstSupervisorLabel' => $label,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'firstSupervisorLabel' => $label,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $firstSupervisorScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $firstSupervisorScores[] = [
                'name' => $label,
                'total' => $totalCriteria,
                'first_supervisor' => $totalFirstCriteria,
                'second_supervisor' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        /*
         * Section for Second Scores
         * */
        $secondSupervisorScoreAttributes = [];
        $secondSupervisorScores = [];
        $totalCriteria = 0;
        foreach ($scoreLabels as $label) {
            $totalCriteria = countFromArray($filteredLecturers, ['secondSupervisorLabel' => $label]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'secondSupervisorLabel' => $label,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'secondSupervisorLabel' => $label,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $secondSupervisorScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $secondSupervisorScores[] = [
                'name' => $label,
                'total' => $totalCriteria,
                'first_supervisor' => $totalFirstCriteria,
                'second_supervisor' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        /* End of C45 Calculation Section */

        $results = [
            [
                'name' => 'HOMEBASE',
                'background' => 'info',
                'items' => $homebases,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $homebaseAttributes),
            ],
            [
                'name' => 'JABATAN FUNGSIONAL',
                'background' => 'success',
                'items' => $functionalJobs,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $functionalJobAttributes),
            ],
            [
                'name' => 'SKOR PEMBIMBING 1',
                'background' => 'warning',
                'items' => $firstSupervisorScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $firstSupervisorScoreAttributes),
            ],
            [
                'name' => 'SKOR PEMBIMBING 2',
                'background' => 'danger',
                'items' => $secondSupervisorScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $secondSupervisorScoreAttributes),
            ],
        ];

        return viewStudyProgramLeader('determination.supervisor.lecturer-list', [
            'thesis' => $thesis,
            'lecturers' => $lecturers,
            'filteredLecturers' => $filteredLecturers,
            'results' => $results,
            'countFilteredLecturers' => $countFilteredLecturers,
            'totalFirstSupervisor' => $totalFirstSupervisor,
            'totalSecondSupervisor' => $totalSecondSupervisor,
            'number' => 1,
            'entropyTotal' => $entropyTotal,
        ]);
    }
}
