<?php

namespace App\Http\Controllers\Leader\Determination;

use App\Constants\AssessmentTypes;
use App\Constants\ScoreTag;
use App\Http\Controllers\Controller;
use App\Models\DataSet;
use App\Models\DataTesting;
use App\Models\Lecturer;
use App\Models\LecturerCompetency;
use App\Models\Root;
use App\Models\SubmissionAssessment;
use App\Services\C45Service;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class TrialExaminerController extends Controller
{
    public function index()
    {
        //Skripsi yang belum ada pembimbingnya
        $nidn = auth()->user()->registration_number;

        $studyProgram = Lecturer::where('nidn', $nidn)->select('study_program_code')->first();
        $submissions = SubmissionAssessment::with(['thesis', 'student'])
            ->whereHas('student', function ($query) use ($studyProgram) {
                $query->where('study_program_code', $studyProgram->study_program_code);
            })
            ->type(AssessmentTypes::TRIAL)
            ->emptyTester()
            ->get();


        return viewStudyProgramLeader('determination.trial-examiner.index', compact('submissions'));
    }

    public function setExaminer(SubmissionAssessment $submission)
    {
        //Load relations
        $submission->load(['student', 'thesis']);

        $filteredLecturers = [];

        $studentStudyProgram = $submission->student->study_program->name;

        // Criteria
        $homebases = [];
        $functionalJobs = [];
        $firstExaminerScores = [];
        $secondExaminerScores = [];

        $totalFirstExaminer = 0;
        $totalSecondExaminer = 0;

        // All Lecturers
        $lecturers = Lecturer::with(['study_program', 'competencies'])
            ->whereHas('study_program', function ($q) {
                $q->where('level', 'S1');
            })
            ->whereNotIn('nidn', [
                $submission->thesis->first_supervisor,
                $submission->thesis->second_supervisor
            ])
            ->orderBy('full_name', 'ASC')
            ->get()
            ->each(function ($lecturer) use ($studentStudyProgram) {
                $lecturer->name = $lecturer->getShortName();

                $lecturer->homebase = $lecturer->study_program->getName();
                $lecturer->asFirstExaminerCount = DataSet::countAsFirstExaminer($lecturer->getFullName());
                $lecturer->asSecondExaminerCount = DataSet::countAsSecondExaminer($lecturer->getFullName());

                $lecturer->firstExaminerLabel = ScoreTag::getFirstLabel($lecturer->asFirstExaminerCount);
                $lecturer->secondExaminerLabel = ScoreTag::getSecondLabel($lecturer->asSecondExaminerCount);
                $lecturer->functional = $lecturer->getLecturship();

                $lecturer->examinerType = ($lecturer->asFirstExaminerCount > $lecturer->asSecondExaminerCount) ? 1 : 2;
                $lecturer->examinerQuota = $lecturer->getTrialExaminerQuotas();

                $lecturer->haveTestedInRelatedStudyProgram = DataSet::checkHaveTestedInRelatedStudyProgram($studentStudyProgram, $lecturer->getFullName());
            });

        DataTesting::query()->truncate();

        foreach ($lecturers as $lecturer) {
            if (($lecturer->asFirstExaminerCount > 0 || $lecturer->asSecondExaminerCount > 0)) {
                $filteredLecturers[] = $lecturer;

                $homebases[] = $lecturer->study_program->getName();
                $functionalJobs[] = $lecturer->functional;
                $firstExaminerScores[] = $lecturer->firstExaminerLabel;
                $secondExaminerScores[] = $lecturer->secondExaminerLabel;

                DataTesting::create([
                    'full_name' => $lecturer->full_name,
                    'homebase' => $lecturer->homebase,
                    'functional' => $lecturer->functional,
                    'count_as_first_examiner' => $lecturer->asFirstExaminerCount,
                    'count_as_second_examiner' => $lecturer->asSecondExaminerCount,
                    'label_as_first_examiner' => $lecturer->firstExaminerLabel,
                    'label_as_second_examiner' => $lecturer->secondExaminerLabel,
                    'quota' => $lecturer->examinerQuota,
                    'examiner_type' => $lecturer->examinerType,
                    'search_order' => 1,
                ]);

                if ($lecturer->examinerType === 1) {
                    $totalFirstExaminer++;
                } else if ($lecturer->examinerType === 2) {
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
                'examinerType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'homebase' => $homebase,
                'examinerType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $homebaseAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $homebases[] = [
                'name' => $homebase,
                'total' => $totalCriteria,
                'first_examiner' => $totalFirstCriteria,
                'second_examiner' => $totalSecondCriteria,
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
                'examinerType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'functional' => $functional,
                'examinerType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $functionalJobAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $functionalJobs[] = [
                'name' => $functional,
                'total' => $totalCriteria,
                'first_examiner' => $totalFirstCriteria,
                'second_examiner' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        usort($functionalJobAttributes, function ($a, $b) {
            return $a['entropy_criteria'] <=> $b['entropy_criteria'];
        });

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
                'examinerType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'firstExaminerLabel' => $label,
                'examinerType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $firstExaminerScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $firstExaminerScores[] = [
                'name' => $label,
                'total' => $totalCriteria,
                'first_examiner' => $totalFirstCriteria,
                'second_examiner' => $totalSecondCriteria,
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
                'examinerType' => 1
            ]);

            $totalSecondCriteria = countFromArray($filteredLecturers, [
                'secondExaminerLabel' => $label,
                'examinerType' => 2
            ]);

            $entropy = C45Service::calculateEntropy($totalCriteria, $totalFirstCriteria, $totalSecondCriteria);
            $secondExaminerScoreAttributes[] = [
                'total_criteria' => $totalCriteria,
                'entropy_criteria' => $entropy,
            ];

            $secondExaminerScores[] = [
                'name' => $label,
                'total' => $totalCriteria,
                'first_examiner' => $totalFirstCriteria,
                'second_examiner' => $totalSecondCriteria,
                'entropy' => $entropy
            ];
        }

        /* End of C45 Calculation Section */

        $results = [
            [
                'key' => 'homebase',
                'name' => 'HOMEBASE',
                'background' => 'info',
                'items' => $homebases,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $homebaseAttributes),
            ],
            [
                'key' => 'functional',
                'name' => 'JABATAN FUNGSIONAL',
                'background' => 'success',
                'items' => $functionalJobs,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $functionalJobAttributes),
            ],
            [
                'key' => 'label_as_first_examiner',
                'name' => 'SKOR PENGUJI 1',
                'background' => 'warning',
                'items' => $firstExaminerScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $firstExaminerScoreAttributes),
            ],
            [
                'key' => 'label_as_second_examiner',
                'name' => 'SKOR PENGUJI 2',
                'background' => 'danger',
                'items' => $secondExaminerScores,
                'gain' => C45Service::calculateGain($entropyTotal, $countFilteredLecturers, $secondExaminerScoreAttributes),
            ],
        ];

        //Sorting results by gain value
        usort($results, function ($a, $b) {
            return $b['gain'] <=> $a['gain'];
        });

        //Fix Examiner
        $firstExaminerCandidate = getFirstExaminer($filteredLecturers, $submission->student->study_program->getName());
        $secondExaminerCandidate = getSecondExaminer($filteredLecturers, $submission->thesis->scienceField->code, $firstExaminerCandidate->nidn);

        return viewStudyProgramLeader('determination.trial-examiner.set-examiner', [
            'submission' => $submission,
            'lecturers' => $lecturers,
            'filteredLecturers' => $filteredLecturers,
            'results' => $results,
            'countFilteredLecturers' => $countFilteredLecturers,
            'totalFirstExaminer' => $totalFirstExaminer,
            'totalSecondExaminer' => $totalSecondExaminer,
            'number' => 1,
            'entropyTotal' => $entropyTotal,

            'firstExaminerCandidate' => $firstExaminerCandidate,
            'secondExaminerCandidate' => $secondExaminerCandidate
        ]);
    }

    public function secondNode(SubmissionAssessment $submission)
    {
        $rootNode = Root::where('index_root', 1)
            ->where('attribute', '!=', 'TOTAL')
            ->orderBy('entropy', 'DESC')
            ->first();

        $columnName = $rootNode->attribute === 'SKOR PENGUJI 1' ? 'label_as_first_examiner' : 'label_as_second_examiner';

        $dataTesting = DataTesting::where($columnName, $rootNode->sub_attribute)->get();

        $totalCases = count($dataTesting);
        $totalFirstExaminer = DataTesting::where($columnName, $rootNode->sub_attribute)->where('examiner_type', 1)->count();
        $totalSecondExaminer = DataTesting::where($columnName, $rootNode->sub_attribute)->where('examiner_type', 2)->count();

        $entropyTotal = C45Service::calculateEntropy($totalCases, $totalFirstExaminer, $totalSecondExaminer);

        //Check root
        $checkSecondNode = Root::where('index_root', 2)
            ->where('attribute', 'TOTAL')
            ->get();
        if (count($checkSecondNode) <= 0) {
            //Insert total first
            Root::create([
                'index_root' => 2,
                'attribute' => 'TOTAL',
                'sub_attribute' => 'TOTAL',
                'total_cases' => $dataTesting->count(),
                'total_first_examiner' => $totalFirstExaminer,
                'total_second_examiner' => $totalSecondExaminer,
                'entropy' => $entropyTotal,
                'gain' => 0.0,
            ]);
        }

        //Homebase
        $homebase = DataTesting::where($columnName, $rootNode->sub_attribute)
            ->select('homebase')
            ->distinct()
            ->pluck('homebase');

        return viewStudyProgramLeader('determination.trial-examiner.second-node', [
            'submission' => $submission,
            'lecturers' => $dataTesting
        ]);
    }

    public function save(Request $request, SubmissionAssessment $submission)
    {
        $this->validate($request, [
            'status' => 'required',
            'first_examiner' => 'required|exists:lecturers,nidn',
            'second_examiner' => 'required|exists:lecturers,nidn|different:first_examiner',
        ]);

        $firstExaminer = $request->get('first_examiner');
        $secondExaminer = $request->get('second_examiner');

        // Use all recomendations
        if (strtolower($request->get('status')) === 'done') {
            $submission->first_examiner = $firstExaminer;
            $submission->second_examiner = $secondExaminer;

            //Update quota
            Lecturer::whereIn('nidn', [$firstExaminer, $secondExaminer])
                ->decrement('quota');

            if ($submission->save()) {
                $message = setFlashMessage('success', 'custom', 'Data penguji sidang skripsi berhasil ditentukan.');
            } else {
                $message = setFlashMessage('error', 'custom', 'Gagal menyimpan data penguji sidang skripsi.');
            }

            return redirect()->route('leader.determination.trial-examiner.index')->with('message', $message);
        }

        $fixExaminer = null;
        $candidates = null;
        $submission->load('thesis');

        if (strtolower($request->get('status')) === 'first') {
            $submission->second_examiner = $secondExaminer;
            $fixExaminer = $secondExaminer;
        }

        if (strtolower($request->get('status')) === 'second') {
            $submission->first_examiner = $firstExaminer;
            $fixExaminer = $firstExaminer;
        }

        //Load all lecturer except supervisor and first examiner
        $candidates = Lecturer::with(['study_program', 'competencies'])
                ->whereNotIn('nidn', [
                    $submission->thesis->first_supervisor,
                    $submission->thesis->second_supervisor,
                    $fixExaminer
                ])->get();

        return viewStudyProgramLeader('determination.trial-examiner.single', [
            'status_change' => $request->get('status'),
            'fix_examiner' => Lecturer::nidn($fixExaminer)->first(),
            'candidates' => $candidates,
            'submission' => $submission
        ]);
    }
}
