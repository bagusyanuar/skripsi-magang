$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function ErrorAlert(title, msg) {
    Swal.fire(title, msg, 'error');
}

function AlertConfirm(title = 'Apakah Anda Yakin?', text = 'Apa anda yakin melanjutkan proses', fn) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya'
    }).then((result) => {
        if (result.value) {
            fn();
        }
    });
}

async function AjaxPost(url, param = {}, onSuccess = function () {}) {
    try {
        let response = await $.post(url, param);
        if (response['status'] === 200) {
            onSuccess();
        }
    } catch (e) {
        ErrorAlert('Error', e.responseText.toString());
    }
}

function DataTableGenerator(element, url = '/', col = [], colDef = [], data = function () {}, extConfig = {}) {
    let baseConfig = {
        scrollX: true,
        processing: true,
        ajax: {
            type: 'GET',
            url: url,
            'data': data
        },
        columnDefs: colDef,
        columns: col,
        paging: true,
    };
    let config = {...baseConfig, ...extConfig};
    return $(element).DataTable(config);
}
