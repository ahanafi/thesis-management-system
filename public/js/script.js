let addFaculty = () => {
    let blockTitle = document.querySelector("#dm-add-server h3.block-title");
    blockTitle.textContent = 'Tambah Data';

    let formFaculty = document.querySelector("#dm-add-server form");
    formFaculty.setAttribute("method", "POST");

    Dashmix.block('open', '#dm-add-server');
}

let editFaculty = (facultyId, facultyCode, facultyName, deanCode) => {
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


