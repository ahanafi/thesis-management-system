<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Constants\AssessmentTypes;
use App\Constants\ScoreTag;
use App\Http\Controllers\Controller;
use App\Models\DataSet;
use App\Models\Lecturer;
use App\Models\SubmissionAssessment;
use App\Models\Thesis;
use App\Services\C45Service;
use Illuminate\Http\Request;

class TrialExaminerController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $submissions =  SubmissionAssessment::with(['thesis', 'student'])
            ->whereHas('student', function ($query) use ($studyProgram) {
                $query->where('study_program_code', $studyProgram->study_program_code);
            })
            ->type(AssessmentTypes::TRIAL)
            ->emptyTester()
            ->get();

        return viewStudyProgramLeader('determination.trial-examiner.index', compact('submissions'));
    }

    public function lecturerList(SubmissionAssessment $submission)
    {
        //Load relations
        $submission->load(['student', 'thesis']);

        $filteredLecturers = [];

        // All Lecturers
        $lecturers = Lecturer::with('study_program')
            ->get()
            ->each(function ($lecturer) {
                $lecturer->asFirstExaminerCount = DataSet::where('first_trial_examiner', 'LIKE', '%' . $lecturer->getFullName() . '%')->count();
                $lecturer->asSecondExaminerCount = DataSet::where('second_trial_examiner', 'LIKE', '%' . $lecturer->getFullName() . '%')->count();
                $lecturer->supervisorType = ($lecturer->asFirstExaminerCount > $lecturer->asSecondExaminerCount) ? 1 : 2;
            });

        // Criteria
        $homebases = [];
        $functionalJobs = [];
        $firstExaminerScores = [];
        $secondExaminerScores = [];

        $totalFirstExaminer = 0;
        $totalSecondExaminer = 0;

        //Filter lecturers
        foreach ($lecturers as $lecturer) {
            if ($lecturer->asFirstExaminerCount > 0 || $lecturer->asSecondExaminerCount > 0) {
                $lectureship = ($lecturer->functional !== null) ? getLecturship($lecturer->functional) : 'NON-JAB';

                $firstExaminerLabel = ScoreTag::getFirstLabel($lecturer->asFirstExaminerCount);
                $secondExaminerLabel = ScoreTag::getSecondLabel($lecturer->asSecondExaminerCount);

                $filteredLecturers[] = (object)[
                    'name' => $lecturer->getShortName(),
                    'homebase' => $lecturer->study_program->getName(),
                    'asFirstExaminerCount' => $lecturer->asFirstExaminerCount,
                    'asSecondExaminerCount' => $lecturer->asSecondExaminerCount,
                    'firstExaminerLabel' => $firstExaminerLabel,
                    'secondExaminerLabel' => $secondExaminerLabel,
                    'functional' => $lectureship,
                    'supervisorType' => $lecturer->supervisorType
                ];

                $homebases[] = $lecturer->study_program->getName();
                $functionalJobs[] = $lectureship;
                $firstExaminerScores[] = $firstExaminerLabel;
                $secondExaminerScores[] = $secondExaminerLabel;

                if ($lecturer->asFirstExaminerCount > 0) {
                    $totalFirstExaminer++;
                } else if ($lecturer->asSecondExaminerCount > 0) {
                    $totalSecondExaminer++;
                }
            }
        }

        $countFilteredLecturers = count($filteredLecturers);

        //Unique Item
        $uniqueHombase = array_values(array_unique($homebases));
        $uniqueFunctional = array_values(array_unique($functionalJobs));

        /* C45 Calculation Section */
        $entropyTotal = C45Service::calculateEntropy($countFilteredLecturers, $totalFirstExaminer, $totalSecondExaminer);

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
        $firstExaminerScoreAttributes = [];
        $firstExaminerScores = [];
        $totalCriteria = 0;
        foreach ($scoreLabels as $label) {
            $totalCriteria = countFromArray($filteredLecturers, ['firstExaminerLabel' => $label]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'firstExaminerLabel' => $label,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'firstExaminerLabel' => $label,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $firstExaminerScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $firstExaminerScores[] = [
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
        $secondExaminerScoreAttributes = [];
        $secondExaminerScores = [];
        $totalCriteria = 0;
        foreach ($scoreLabels as $label) {
            $totalCriteria = countFromArray($filteredLecturers, ['secondExaminerLabel' => $label]);
            $totalFirstCriteria = countFromArray($filteredLecturers, [
                'secondExaminerLabel' => $label,
                'supervisorType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'secondExaminerLabel' => $label,
                'supervisorType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $secondExaminerScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $secondExaminerScores[] = [
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
                'name' => 'SKOR PENGUJI 1',
                'background' => 'warning',
                'items' => $firstExaminerScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $firstExaminerScoreAttributes),
            ],
            [
                'name' => 'SKOR PENGUJI 2',
                'background' => 'danger',
                'items' => $secondExaminerScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $secondExaminerScoreAttributes),
            ],
        ];

        return viewStudyProgramLeader('determination.trial-examiner.lecturer-list', [
            'submission' => $submission,
            'lecturers' => $lecturers,
            'filteredLecturers' => $filteredLecturers,
            'results' => $results,
            'countFilteredLecturers' => $countFilteredLecturers,
            'totalFirstExaminer' => $totalFirstExaminer,
            'totalSecondExaminer' => $totalSecondExaminer,
            'number' => 1,
            'entropyTotal' => $entropyTotal,
        ]);
    }

    public function setExaminer(SubmissionAssessment $submission)
    {
        $submission->load(['student', 'thesis']);

        $studyProgramCode = $submission->student->study_program_code;
        $firstExaminerCandidates = Lecturer::studyProgramCode($studyProgramCode)
            ->whereNotIn('nidn', [
                $submission->thesis->first_supervisor,
                $submission->thesis->second_supervisor
            ])
            ->get();

        $lecturers = Lecturer::select('full_name', 'nidn', 'degree')
            ->whereNotIn('nidn', [
                $submission->thesis->first_supervisor,
                $submission->thesis->second_supervisor
            ])
            ->get();

        return viewStudyProgramLeader('determination.trial-examiner.single', compact('submission', 'lecturers', 'firstExaminerCandidates'));
    }

    public function save(Request $request, SubmissionAssessment $submission)
    {
        $this->validate($request, [
            'first_examiner' => 'required|exists:lecturers,nidn',
            'second_examiner' => 'required|exists:lecturers,nidn|different:first_examiner',
        ]);

        $submission->first_examiner = $request->get('first_examiner');
        $submission->second_examiner = $request->get('second_examiner');

        if ($submission->save()) {
            $message = setFlashMessage('success', 'custom', 'Data penguji seminar skripsi berhasil ditentukan.');
        } else {
            $message = setFlashMessage('error', 'custom', 'Gagal menyimpan data penguji seminar skripsi.');
        }

        return redirect()->route('leader.determination.trial-examiner.index')->with('message', $message);
    }
}
