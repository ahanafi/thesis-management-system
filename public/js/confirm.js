let confirmDelete = (dataType, dataId) => {
    if (dataType !== '' && dataId !== '') {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan menghapus data ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#dc3544',
            confirmButtonText: 'Ya, Hapus.',
            cancelButtonText: 'Batalkan',
        }).then((value) => {
            if (value.isConfirmed) {
                const actionURL = `/${dataType}/${dataId}`;

                const body = document.querySelector("body");

                //Form Delete
                const form = document.createElement("form");
                form.setAttribute("method", "POST");
                form.setAttribute("action", actionURL);

                //Input Method
                const inputMethod = document.createElement("input");
                inputMethod.setAttribute("type", "hidden");
                inputMethod.setAttribute("name", "_method");
                inputMethod.setAttribute("value", "DELETE");

                //Input Token
                const inputToken = document.createElement("input");
                const token = document.querySelector("meta[name=csrf-token]").getAttribute('content')
                inputToken.setAttribute("type", "hidden");
                inputToken.setAttribute("name", "_token");
                inputToken.setAttribute("value", token);

                const br = document.createElement("br");

                form.appendChild(inputToken)
                form.appendChild(br.cloneNode());
                form.appendChild(inputMethod);

                form.setAttribute('action', actionURL);

                body.appendChild(form);
                form.submit();
            }
        });
    }
}

let confirmLogout = () => {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin akan keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3544',
        confirmButtonText: 'Ya, Keluar.',
        //cancelButtonColor: '',
        cancelButtonText: 'Batalkan',
    }).then((value) => {
        if (value.isConfirmed) {
            const body = document.querySelector("body");
            const actionURL = `/logout`;

            //Form logout
            const form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", actionURL);

            const inputMethod = document.createElement("input");
            const token = document.querySelector("meta[name=csrf-token]").getAttribute('content');
            inputMethod.setAttribute("type", "hidden");
            inputMethod.setAttribute("name", "_token");
            inputMethod.setAttribute("value", token);

            form.appendChild(inputMethod);

            form.setAttribute('action', actionURL);

            body.appendChild(form);
            form.submit();
        }
    });
}

let applyThesisRequirement = () => {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Pastikan Anda telah mengecek ulang dokumen yang telah diunggah.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya, Ajukan',
        cancelButtonText: 'Batalkan',
    }).then((value) => {
        if (value.isConfirmed) {
            document.querySelector("#form-apply").submit();
        }
    });
}

let truncateDataSet = () => {
    Swal.fire({
        title: 'Konfirmasi!',
        text: 'Apakah Anda yakin akan menghapus seluruh data set skripsi? Data tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3544',
        confirmButtonText: 'Ya, Hapus.',
        cancelButtonText: 'Batal',
    }).then((value) => {
        if (value.isConfirmed) {
            document.querySelector("#form-destroy").submit();
        }
    });
}
