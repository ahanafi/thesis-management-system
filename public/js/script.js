/* FACULTY */
const addFaculty = () => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    let formFaculty = document.querySelector("#dm-add-server form");
    formFaculty.setAttribute("method", "POST");

    Dashmix.block('open', '#dm-add-server');
}

const editFaculty = (facultyId, facultyCode, facultyName, deanCode) => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Edit Data';
    let action = `/master/faculties/${facultyId}`;

    let formFaculty = document.querySelector("#dm-add-server form");
    formFaculty.setAttribute("method", "POST");
    formFaculty.setAttribute("action", action);

    let inputFacultyCode = document.querySelector("#dm-add-server input[name=faculty_code]");
    let inputFacultyName = document.querySelector("#dm-add-server input[name=faculty_name]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");
    let selectLecturers = document.querySelector("#dm-add-server select[name=dean_code]");

    inputFacultyCode.value = facultyCode;
    inputFacultyName.value = facultyName;
    inputMethod.value = "PUT";


    Dashmix.block('open', '#dm-add-server');
}


/* STUDY PROGRAM */
const addStudyProgram = () => {
    const blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    const formStudyProgram = document.querySelector("#dm-add-server form");
    formStudyProgram.setAttribute("method", "POST");
    formStudyProgram.setAttribute('action', '/master/study-program');

    document.querySelector("#dm-add-server input[name=name]").value = '';
    document.querySelector("#dm-add-server input[name=study_program_code]").value = '';
    document.querySelector("#dm-add-server input[name=_method]").value = 'POST';

    const lecturerOptions = document.querySelectorAll("#dm-add-server select[name=lecturer_code] > option");
    lecturerOptions.forEach((opt, index) => (opt.value === '') ? opt.setAttribute('selected', 'selected') : '');

    const facultiesOptions = document.querySelectorAll("#dm-add-server select[name=faculty_code] > option");
    facultiesOptions.forEach((opt, index) => (opt.value === '') ? opt.setAttribute('selected', 'selected') : '');

    const levelOptions = document.querySelectorAll("#dm-add-server select[name=level] > option");
    levelOptions.forEach((opt, index) => (opt.value === '') ? opt.setAttribute('selected', 'selected') : '');

    Dashmix.block('open', '#dm-add-server');
}

const editStudyProgram = (studyProgramId, studyProgramCode, name, level, facultyCode, lecturerCode) => {
    const blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Edit Data';
    const action = `/master/study-programs/${studyProgramId}`;

    const formStudyProgram = document.querySelector("#dm-add-server form");
    formStudyProgram.setAttribute("method", "POST");
    formStudyProgram.setAttribute("action", action);

    const inputStudyProgramName = document.querySelector("#dm-add-server input[name=name]");
    const inputStudyProgramCode = document.querySelector("#dm-add-server input[name=study_program_code]");
    const inputMethod = document.querySelector("#dm-add-server input[name=_method]");
    inputStudyProgramName.value = name;
    inputStudyProgramCode.value = studyProgramCode;
    inputMethod.value = "PUT";

    const lecturerOptions = document.querySelectorAll("#dm-add-server select[name=lecturer_code] > option");
    lecturerOptions.forEach((opt, index) => (opt.value === lecturerCode) ? opt.setAttribute('selected', 'selected') : '');

    const facultiesOptions = document.querySelectorAll("#dm-add-server select[name=faculty_code] > option");
    facultiesOptions.forEach((opt, index) => (opt.value === facultyCode) ? opt.setAttribute('selected', 'selected') : '');

    const levelOptions = document.querySelectorAll("#dm-add-server select[name=level] > option");
    levelOptions.forEach((opt, index) => (opt.value.toLowerCase() === level.toLowerCase()) ? opt.setAttribute('selected', 'selected') : '');

    Dashmix.block('open', '#dm-add-server');
}


/* SCIENCE FIELD */
const addScienceField = () => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    let formScienceField = document.querySelector("#dm-add-server form");
    formScienceField.setAttribute("method", "POST");

    Dashmix.block('open', '#dm-add-server');
}

const editScienceField = (scienceFieldId, scienceFieldCode, scienceFieldName) => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Edit Data';
    let action = `/master/science-fields/${scienceFieldId}`;

    let formScienceField = document.querySelector("#dm-add-server form");
    formScienceField.setAttribute("method", "POST");
    formScienceField.setAttribute("action", action);

    let inputScienceFieldCode = document.querySelector("#dm-add-server input[name=code]");
    let inputScienceFieldName = document.querySelector("#dm-add-server input[name=name]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");

    inputScienceFieldCode.value = scienceFieldCode;
    inputScienceFieldName.value = scienceFieldName;
    inputMethod.value = "PUT";

    Dashmix.block('open', '#dm-add-server');
}

/* THESIS REQUIREMENT */
const addThesisRequirement = () => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    let formThesisRequirement = document.querySelector("#dm-add-server form");
    formThesisRequirement.setAttribute("method", "POST");
    formThesisRequirement.setAttribute("action", '/thesis-requirements');

    let inputDocumentName = document.querySelector("#dm-add-server input[name=document_name]");
    let inputNote = document.querySelector("#dm-add-server input[name=note]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");
    let inputIsRequired = document.querySelector("#is-required");

    const documentTypeOptions = document.querySelectorAll("#dm-add-server select[name=document_type] > option");
    documentTypeOptions.forEach((opt, index) => (opt.value === '') ? opt.setAttribute('selected', 'selected') : '');

    inputDocumentName.value = '';
    inputNote.value = '';
    inputIsRequired.setAttribute('checked', 'checked');

    inputMethod.value = "POST";

    Dashmix.block('open', '#dm-add-server');
}

const editThesisRequirement = (thesisRequirementId, documentName, documentType, isRequired, note) => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Edit Data';
    let action = `/thesis-requirements/${thesisRequirementId}`;

    let formThesisRequirement = document.querySelector("#dm-add-server form");
    formThesisRequirement.setAttribute("method", "POST");
    formThesisRequirement.setAttribute("action", action);

    let inputDocumentName = document.querySelector("#dm-add-server input[name=document_name]");
    let inputNote = document.querySelector("#dm-add-server input[name=note]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");
    let inputIsRequired = document.querySelector("#is-required");

    const documentTypeOptions = document.querySelectorAll("#dm-add-server select[name=document_type] > option");
    documentTypeOptions.forEach((opt, index) => {
        (opt.value.toLowerCase() === documentType.toLowerCase()) ? opt.setAttribute('selected', 'selected') : (opt.hasAttribute('selected') ? opt.removeAttribute('selected') : '');
    });

    inputDocumentName.value = documentName;
    inputNote.value = note;

    if (parseInt(isRequired) === 1) {
        inputIsRequired.setAttribute('checked', 'checked');
    } else {
        inputIsRequired.removeAttribute('checked');
    }

    inputMethod.value = "PUT";

    Dashmix.block('open', '#dm-add-server');
}


/* THESIS REQUIREMENT */
const addAssessmentComponent = () => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    let formAssessmentComponent = document.querySelector("#dm-add-server form");
    formAssessmentComponent.setAttribute("method", "POST");
    formAssessmentComponent.setAttribute("action", '/assessment-component');

    let inputName = document.querySelector("#dm-add-server input[name=name]");
    let inputWeight = document.querySelector("#dm-add-server input[name=weight]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");

    const assessmentTypeOptions = document.querySelectorAll("#dm-add-server select[name=assessment_type] > option");
    assessmentTypeOptions.forEach((opt, index) => (opt.value === '') ? opt.setAttribute('selected', 'selected') : '');

    inputName.value = '';
    inputWeight.value = '';
    inputMethod.value = "POST";

    Dashmix.block('open', '#dm-add-server');
}

const editAssessmentComponent = (assessmentComponentId, name, assessmentType, weight) => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Edit Data';
    let action = `/assessment-component/${assessmentComponentId}`;

    let formAssessmentComponent = document.querySelector("#dm-add-server form");
    formAssessmentComponent.setAttribute("method", "POST");
    formAssessmentComponent.setAttribute("action", action);

    let inputName = document.querySelector("#dm-add-server input[name=name]");
    let inputWeight = document.querySelector("#dm-add-server input[name=weight]");
    let inputMethod = document.querySelector("#dm-add-server input[name=_method]");

    const assessmentTypeOptions = document.querySelectorAll("#dm-add-server select[name=assessment_type] > option");
    assessmentTypeOptions.forEach((opt, index) => (opt.value.toLowerCase() === assessmentType.toLowerCase()) ? opt.setAttribute('selected', 'selected') : (opt.hasAttribute('selected') ? opt.removeAttribute('selected') : ''));

    inputName.value = name;
    inputWeight.value = weight;
    inputMethod.value = 'PUT';

    Dashmix.block('open', '#dm-add-server');
}

const showDocument = (path, documentType) => {
    let elType = documentType.toLowerCase() === 'pdf' ? 'iframe' : 'img';
    let element = document.createElement(elType);
    element.setAttribute('src', path);
    if (documentType.toLowerCase() === 'pdf') {
        element.setAttribute("width", '100%');
        element.setAttribute("height", '400px');
    }
    let view = document.querySelector("#view");

    while (view.lastElementChild) {
        view.removeChild(view.lastElementChild);
    }

    view.append(element);
    $("#modal-detail-document").modal('show');
}

const submitResponse = (type) => {
    const form = document.querySelector("#submit-response");
    const inputTypeResponse = document.createElement("input");
    inputTypeResponse.setAttribute('type', 'hidden');
    inputTypeResponse.setAttribute('name', 'response_type');
    inputTypeResponse.setAttribute('value', type);
    form.appendChild(inputTypeResponse);
    form.submit();
}

const submitThesisSubmissionResponse = (responseType) => {
    if (responseType !== undefined) {
        const responseNote = document.querySelector("#note");
        if (responseNote.value.toString().replace(" ", '') === '') {
            Swal.fire({
                title: 'Perhatian',
                text: 'Harap masukkan catatan terlebih dahulu!.',
                icon: 'warning',
                timer: 1500
            });
            responseNote.classList.add('is-invalid');
            responseNote.setAttribute('aria-invalid', true);
        } else {
            const messageType = responseType === 'REJECT' ? 'menolak' : 'menerima';
            const confirmButtonColor = responseType === 'REJECT' ? '#e04f1a' : '#82b54b';
            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin akan ${messageType} proposal Skripsi ini?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                confirmButtonText: 'Ya, Lanjutkan.',
                cancelButtonText: 'Batalkan',
            }).then((value) => {
                if (value.isConfirmed) {
                    const form = document.querySelector("#thesis-submission-response");
                    const inputTypeResponse = document.createElement("input");
                    inputTypeResponse.setAttribute('type', 'hidden');
                    inputTypeResponse.setAttribute('name', 'response_type');
                    inputTypeResponse.setAttribute('value', responseType);
                    form.appendChild(inputTypeResponse);
                    form.submit();
                }
            });
        }
    }
}

const validateNotes = (el) => {
    const notes = el.value;
    if(notes.length > 1) {
        el.classList.remove('is-invalid');
    } else {
        el.classList.add('is-invalid');
        el.focus();
    }
}
