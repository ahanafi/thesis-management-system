<?php
if(!function_exists('educationLevel')) {
    function educationLevel($key = null) {
        $educationLevels = [
            'D1', 'D2', 'D3', 'D4',
            'S1', 'S2', 'S3'
        ];
        if($key !== null && in_array($key, $educationLevels)) {
            return $key;
        }

        return $educationLevels;
    }
}

if(!function_exists('userLevel')) {
    function userLevel($level = null) {
        $userLevels = [
            'ACADEMIC_STAFF' => 'BAAK',
            'STUDENT' => 'Mahasiswa',
            'STUDY_PROGRAM_LEADER' => 'Kaprodi',
            'LECTURER' => 'Dosen'
        ];

        if($level !== null && key_exists($level, $userLevels)) {
            return $userLevels[$level];
        }

        return $userLevels;
    }
}

if(!function_exists('userBadge')) {
    function userBadge($level) {
        $badgeColor = [
            'ACADEMIC_STAFF' => 'success',
            'STUDENT' => 'info',
            'STUDY_PROGRAM_LEADER' => 'warning',
            'LECTURER' => 'primary'
        ];

        if($level !== null && key_exists($level, $badgeColor)) {
            $color = $badgeColor[$level];
            $userLevel = strtoupper(userLevel($level));
            return "<span class='badge badge-$color'>$userLevel</span>";
        }
    }
}

if(!function_exists('getLecturship')) {
    function getLecturship($key = null) {
        $posisitions = [
            'EXPERT_ASSISTANT' => 'Asisten Ahli',
            'LECTURER' => 'Lektor',
            'CHIEF_LECTURER' => 'Lektor Kepala',
            'PROFESSOR' =>  'Profesor'
        ];

        if($key !== null && key_exists($key, $posisitions)) {
            return $posisitions[$key];
        }

        return $posisitions;
    }
}

if(!function_exists('setFlashMessage')) {
    function setFlashMessage($type, $actionType, $dataType) {
        $messageText = "";
        $messageType = "";
        $messageStatus = ($type == 'success') ? " berhasil " : " gagal ";

        if (in_array($actionType, ['insert', 'add'])) {
            $messageType = " disimpan!";
        } else if (in_array($actionType, ['update', 'edit'])) {
            $messageType = " diperbarui!";
        } else if (in_array($actionType, ['delete', 'destroy', 'remove'])) {
            $messageType = " dihapus!";
        } else if($actionType == 'upload') {
            $messageType = " diupload!";
        }

        $messageText = "Data " . $dataType . $messageStatus . $messageType;

        //For customize message
        if($actionType == 'custom') {
            $messageText = $dataType;
        }

        return [
            'type' => $type,
            'text' => $messageText,
        ];
    }
}

if(!function_exists('getTypeOfAssessment')) {
    function getTypeOfAssessment($key = null) {
        $typeOfAssessment = [
            'SEMINAR' => 'Seminar',
            'TRIAL' => 'Sidang',
            'COLLOQUIUM' => 'Kolokium'
        ];

        if($key !== null && key_exists($key, $typeOfAssessment)) {
            return $typeOfAssessment[$key] . " Skripsi";
        }

        return $typeOfAssessment;
    }
}

if(!function_exists('documentTypes')) {
    function documentTypes($key = null) {
        $types = [
            'image' => 'JPG, PNG, JPEG',
            'document' => 'PDF, DOC, DOCX',
            'archive' => 'ZIP, RAR, GZIP'
        ];

        if($key !== null && key_exists($key, $types)) {
            return $types[$key];
        }

        return $types;
    }
}

if(!function_exists('viewAcademicStaff')) {
    function viewAcademicStaff($view = null, $data = []) {
        return view('academic-staff.' . $view, $data);
    }
}

if(!function_exists('viewStudent')) {
    function viewStudent($view = null, $data = []) {
        return view('student.' . $view, $data);
    }
}

if(!function_exists('viewStudyProgramLeader')) {
    function viewStudyProgramLeader($view = null, $data = []) {
        return view('study-program-leader.' . $view, $data);
    }
}

if(!function_exists('viewLecturer')) {
    function viewLecturer($view = null, $data = []) {
        return view('lecturer.' . $view, $data);
    }
}

if(!function_exists('getStatus')) {
    function getStatus($statusCode) {
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

        if($statusCode !== null && key_exists($statusCode, $status)) {
            $text = strtoupper($status[$statusCode]['text']);
            $class = $status[$statusCode]['class'];
        }

        return "<span class='badge badge-$class'>$text</span>";
    }
}
