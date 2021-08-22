<?php

use App\Models\Lecturer;
use App\Models\Score;

if (!function_exists('educationLevel')) {
    function educationLevel($key = null)
    {
        $educationLevels = [
            'D1', 'D2', 'D3', 'D4',
            'S1', 'S2', 'S3'
        ];
        if ($key !== null && in_array($key, $educationLevels)) {
            return $key;
        }

        return $educationLevels;
    }
}

if (!function_exists('studyProgramShortName')) {
    function studyProgramShortName($fullStudyProgramName = null)
    {
        $studyProgramName = "";
        $names = explode(" ", $fullStudyProgramName);
        if (count($names) > 1) {
            foreach ($names as $name) {
                $studyProgramName .= strtoupper($name[0]);
            }
            return $studyProgramName;
        }

        return $fullStudyProgramName;
    }
}

if (!function_exists('showName')) {
    function showName($fullName, $degree = '')
    {
        $names = explode(" ", ucwords(strtolower($fullName)));

        if (count($names) <= 2) {
            return ucwords(strtolower($fullName)) . " " . $degree;
        }

        $firstName = $names[0] . " " . $names[1];
        $lastName = "";
        foreach ($names as $key => $val) {
            if ($key >= 2 && !empty($val)) {
                $lastName .= $val[0] . ".";
            }
        }

        return $firstName . " " . $lastName . " " . $degree;
    }
}

if (!function_exists('userLevel')) {
    function userLevel($level = null)
    {
        $userLevels = [
            'ACADEMIC_STAFF' => 'BAAK',
            'STUDENT' => 'Mahasiswa',
            'STUDY_PROGRAM_LEADER' => 'Kaprodi',
            'LECTURER' => 'Dosen'
        ];

        if ($level !== null && key_exists($level, $userLevels)) {
            return $userLevels[$level];
        }

        return $userLevels;
    }
}

if (!function_exists('userBadge')) {
    function userBadge($level)
    {
        $badgeColor = [
            'ACADEMIC_STAFF' => 'success',
            'STUDENT' => 'info',
            'STUDY_PROGRAM_LEADER' => 'warning',
            'LECTURER' => 'primary'
        ];

        if ($level !== null && key_exists($level, $badgeColor)) {
            $color = $badgeColor[$level];
            $userLevel = strtoupper(userLevel($level));
            return "<span class='badge badge-$color'>$userLevel</span>";
        }
    }
}

if (!function_exists('getLecturship')) {
    function getLecturship($key = null)
    {
        $posisitions = [
            'EXPERT_ASSISTANT' => 'Asisten Ahli',
            'LECTURER' => 'Lektor',
            'CHIEF_LECTURER' => 'Lektor Kepala',
            'PROFESSOR' => 'Profesor'
        ];

        if ($key !== null && key_exists($key, $posisitions)) {
            return $posisitions[$key];
        }

        return $posisitions;
    }
}

if (!function_exists('setFlashMessage')) {
    function setFlashMessage($type, $actionType, $dataType)
    {
        $messageText = "";
        $messageType = "";
        $messageStatus = ($type === 'success') ? " berhasil " : " gagal ";

        if (in_array($actionType, ['insert', 'add'])) {
            $messageType = " disimpan!";
        } else if (in_array($actionType, ['update', 'edit'])) {
            $messageType = " diperbarui!";
        } else if (in_array($actionType, ['delete', 'destroy', 'remove'])) {
            $messageType = " dihapus!";
        } else if ($actionType === 'upload') {
            $messageType = " diupload!";
        }

        $messageText = "Data " . $dataType . $messageStatus . $messageType;

        //For customize message
        if ($actionType === 'custom') {
            $messageText = $dataType;
        }

        return [
            'type' => $type,
            'text' => $messageText,
        ];
    }
}

if (!function_exists('getTypeOfAssessment')) {
    function getTypeOfAssessment($key = null)
    {
        if (strtoupper($key) === 'FINAL-TEST') {
            $key = 'TRIAL';
        }

        $typeOfAssessment = [
            'SEMINAR' => 'Seminar',
            'TRIAL' => 'Sidang',
            'COLLOQUIUM' => 'Kolokium'
        ];

        if ($key !== null && key_exists($key, $typeOfAssessment)) {
            return $typeOfAssessment[$key] . " Skripsi";
        }

        return $typeOfAssessment;
    }
}

if (!function_exists('documentTypes')) {
    function documentTypes($key = null)
    {
        $types = [
            'image' => 'JPG, PNG, JPEG',
            'document' => 'PDF, DOC, DOCX',
            'archive' => 'ZIP, RAR, GZIP'
        ];

        if ($key !== null && key_exists($key, $types)) {
            return $types[$key];
        }

        return $types;
    }
}

if (!function_exists('viewAcademicStaff')) {
    function viewAcademicStaff($view = null, $data = [])
    {
        return view('academic-staff.' . $view, $data);
    }
}

if (!function_exists('viewStudent')) {
    function viewStudent($view = null, $data = [])
    {
        return view('student.' . $view, $data);
    }
}

if (!function_exists('viewStudyProgramLeader')) {
    function viewStudyProgramLeader($view = null, $data = [])
    {
        return view('study-program-leader.' . $view, $data);
    }
}

if (!function_exists('viewLecturer')) {
    function viewLecturer($view = null, $data = [])
    {
        return view('lecturer.' . $view, $data);
    }
}

if (!function_exists('getStatus')) {
    function getStatus($statusCode)
    {
        $status = [
            'WAITING' => [
                'text' => 'Menunggu',
                'class' => 'warning'
            ],
            'APPROVE' => [
                'text' => 'Diterima/Disetujui',
                'class' => 'success'
            ],
            'REJECT' => [
                'text' => 'Ditolak',
                'class' => 'danger'
            ]
        ];

        $text = "";
        $class = "secondary";

        if ($statusCode !== null && key_exists($statusCode, $status)) {
            $text = strtoupper($status[$statusCode]['text']);
            $class = $status[$statusCode]['class'];
        }

        return "<span class='badge badge-$class'>$text</span>";
    }
}

if (!function_exists('super_unique')) {
    function super_unique($array, $key)
    {
        $temp = array_unique(array_column($array, $key));
        return array_intersect_key($array, $temp);
    }
}

if (!function_exists('countFromArray')) {
    function countFromArray($array, $conditions = [])
    {
        $count = 0;
        $countConditions = count($conditions);
        if ($countConditions <= 1) {
            $key = array_key_first($conditions);
            $value = $conditions[$key];
            foreach ($array as $item) {
                if (isset($item->{$key}) && $item->{$key} === $value) {
                    $count++;
                }
            }

        } else if ($countConditions === 2) {
            foreach ($array as $item) {
                $firstKey = array_keys($conditions)[0];
                $firstValue = array_values($conditions)[0];

                $secondKey = array_keys($conditions)[1];
                $secondValue = array_values($conditions)[1];

                if (is_array($item) && (array_key_exists($firstKey, $item) && $item[$firstKey] === $firstValue) &&
                    (array_key_exists($secondKey, $item) && $item[$secondKey] === $secondValue)) {
                    $count++;
                }

                if (is_object($item)) {
                    if ($item instanceof Lecturer && $item->{$firstKey} === $firstValue && $item->{$secondKey} === $secondValue) {
                        $count++;
                    } else if ((property_exists($item, $firstKey) && $item->{$firstKey} === $firstValue) &&
                        (property_exists($item, $secondKey) && $item->{$secondKey} === $secondValue)) {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }
}

if (!function_exists('lastUriSegment')) {
    function lastUriSegment()
    {
        $index = count(request()->segments());
        return request()->segment($index);
    }
}

if (!function_exists('idDateFormat')) {
    function idDateFormat($date)
    {
        $tempDate = explode("-", $date);
        $tempDate = array_reverse($tempDate);
        return implode("-", $tempDate);
    }
}

if(!function_exists('getFirstExaminerByLecturer')) {
    function getFirstExaminerByLecturer(array $lecturers, $studyProgramOfStudent) {
        $countFunctionalLecturer = countFromArray($lecturers, [
            'functional' => 'Lektor',
            'homebase' => $studyProgramOfStudent
        ]);
        $examiner = null;

        if($countFunctionalLecturer === 1) {
            foreach ($lecturers as $lecturer) {
                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'lektor') {
                    $examiner = $lecturer;
                    break;
                }
            }
        } else if($countFunctionalLecturer > 1) {
            $filteredLecturers = [];
            foreach ($lecturers as $lecturer) {
                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'lektor') {
                    $filteredLecturers[] = $lecturer;
                }
            }

            //Sort by quota
            usort($filteredLecturers, function ($a, $b) {
                return $b->quota <=> $a->quota;
            });

            $examiner = $filteredLecturers[0];
        }

        return $examiner;
    }
}

if(!function_exists('getFirstExaminerByExpertAssistant')) {
    function getFirstExaminerByExpertAssistant(array $lecturers, $studyProgramOfStudent) {
        $countFunctionalExpertAssisstant = countFromArray($lecturers, [
            'functional' => 'Asisten Ahli',
            'homebase' => $studyProgramOfStudent
        ]);
        $examiner = null;

        if($countFunctionalExpertAssisstant === 1) {
            foreach ($lecturers as $lecturer) {
                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'asisten ahli') {
                    $examiner = $lecturer;
                    break;
                }
            }
        } else if($countFunctionalExpertAssisstant > 1) {
            $filteredLecturers = [];

            $filterFirstExaminerLabel = [];

            foreach ($lecturers as $lecturer) {
                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'asisten ahli') {

                    if(strtolower($lecturer->firstExaminerLabel) === 'sangat tinggi' || strtolower($lecturer->firstExaminerLabel) === 'tinggi') {
                        $filterFirstExaminerLabel[] = $lecturer;
                    } else {
                        $filteredLecturers[] = $lecturer;
                    }
                }
            }

            if(count($filterFirstExaminerLabel) > 0) {
                //Sort by quota
                usort($filterFirstExaminerLabel, function ($a, $b) {
                    return $b->quota <=> $a->quota;
                });

                $examiner = $filterFirstExaminerLabel[0];
            } else {
                //Sort by quota
                usort($filteredLecturers, function ($a, $b) {
                    return $b->quota <=> $a->quota;
                });

                $examiner = $filteredLecturers[0];
            }

        }

        return $examiner;
    }
}


if (!function_exists('getFirstExaminer')) {

    /*
     * First examiner must be have homebase equals with study Program of student
     *
     * */
    function getFirstExaminer(array $lecturers, $studyProgramOfStudent)
    {
        $firstExaminerByFunctionalAsLectur = getFirstExaminerByLecturer($lecturers, $studyProgramOfStudent);

        if($firstExaminerByFunctionalAsLectur !== null) {
            return $firstExaminerByFunctionalAsLectur;
        } else {
            return getFirstExaminerByExpertAssistant($lecturers, $studyProgramOfStudent);
        }

//        $firstExaminer = null;
//        $filteredLecturers = [];
//        foreach ($lecturers as $lecturer) {
//            if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'lektor') {
//                $countFunctionalLecturer++;
//                $filteredLecturers[] = $lecturer;
//            }
//        }
//
//        if ($countFunctionalLecturer === 1) {
//            foreach ($lecturers as $lecturer) {
//                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'lektor') {
//                    $firstExaminer = $lecturer;
//                    break;
//                }
//            }
//
//        } else if($countFunctionalLecturer > 1) {
//
//            usort($filteredLecturers, function ($a, $b) {
//                return $b->quota <=> $a->quota;
//            });
//
////            foreach ($lecturers as $lecturer) {
////                if (($lecturer->homebase === $studyProgramOfStudent) &&
////                    (strtolower($lecturer->functional) === 'lektor') &&
////                    (strtolower($lecturer->firstExaminerLabel) === 'sangat tinggi') &&
////                    (strtolower($lecturer->secondExaminerLabel) === 'sangat tinggi')
////                ) {
////                    $firstExaminer = $lecturer;
////                    break;
////                }
////            }
//            $firstExaminer = $filteredLecturers[0];
//        } else {
//
//            foreach ($lecturers as $lecturer) {
//                if ($lecturer->homebase === $studyProgramOfStudent && strtolower($lecturer->functional) === 'asisten ahli') {
//                    $countFunctionalLecturer++;
//                    $filteredLecturers[] = $lecturer;
//                }
//            }
//        }
//
//        return $firstExaminer;
    }
}

if (!function_exists('getSecondExaminer')) {
    function getSecondExaminer(array $lecturers, $scienceFieldCode, $firstExaminerCandidate)
    {
        $foundByScienceField = false;
        $secondExaminer = null;

        $foundByFunctionalAsLecturer = false;
        $foundByFunctionalAsExpertAssisstant = false;
        foreach ($lecturers as $lecturer) {
            if ($lecturer->competencies !== null) {
                foreach ($lecturer->competencies as $competency) {
                    if ($competency->code === $scienceFieldCode) {
                        $foundByScienceField = true;
                        $secondExaminer = $lecturer;
                        break;
                    }
                }
            }
        }

        if ($foundByScienceField) {
            return $secondExaminer;
        } else {
            foreach ($lecturers as $lecturer) {
                if ($lecturer->nidn !== $firstExaminerCandidate && strtolower($lecturer->functional) === 'lektor' && (strtolower($lecturer->secondExaminerLabel) === 'sangat tinggi' || strtolower($lecturer->secondExaminerLabel) === 'tinggi')) {
                    $foundByFunctionalAsLecturer = true;
                    $secondExaminer = $lecturer;
                    break;
                }
            }

            if ($foundByFunctionalAsLecturer) {
                return $secondExaminer;
            } else {
                foreach ($lecturers as $lecturer) {
                    if ($lecturer->nidn !== $firstExaminerCandidate && strtolower($lecturer->functional) === 'asisten ahli' && (strtolower($lecturer->secondExaminerLabel) === 'sangat tinggi' || strtolower($lecturer->secondExaminerLabel) === 'tinggi')) {
                        $foundByFunctionalAsExpertAssisstant = true;
                        $secondExaminer = $lecturer;
                        break;
                    }
                }

                if($foundByFunctionalAsExpertAssisstant) {
                    return $secondExaminer;
                } else {
                    return null;
                }
            }
        }
    }
}

if(!function_exists('insertTrialScore')) {
    function insertTrialScore($thesisId, $nim, $score) {
        $checkScore = Score::where('thesis_id', $thesisId)
            ->where('nim', $nim)
            ->first();

        if($checkScore && $checkScore->trial === null) {
            $checkScore->trial = $score;
            $checkScore->save();
        }

        if(!$checkScore) {
            Score::create([
                'thesis_id' => $thesisId,
                'nim' => $nim,
                'trial' => $score
            ]);
        }
    }
}
