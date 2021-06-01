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
    let action = `/master/faculty/${facultyId}`;

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
    const action = `/master/study-program/${studyProgramId}`;

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
    let action = `/master/science-field/${scienceFieldId}`;

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
