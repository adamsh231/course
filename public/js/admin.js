$(document).ready(function () {
    $('#add-error-bag').hide();
    $('#edit-error-bag').hide();
    $('#siswa_table').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
});
function add_siswa() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/siswa',
        data: {
            name: $("#form_add input[name=name]").val(),
            username: $("#form_add input[name=username]").val(),
            password: $("#form_add input[name=password]").val(),
            email: $("#form_add input[name=email]").val(),
            phone: $("#form_add input[name=phone]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_siswa .close").click();
            Swal.fire({
                title: 'Berhasil ditambahkan!',
                type: 'success',
                showConfirmButton: false,
            });
            setInterval(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#add-error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add-error').append('<li>' + value + '</li>');
            });
            $("#add-error-bag").show();
        }
    });
}

function fill_edit(id) {
    $.ajax({
        type: 'GET',
        url: '/admin/siswa/' + id,
        beforeSend: function () {
            $("#edit-error-bag").hide();
            $("#form_edit input[name=name]").val('');
            $("#form_edit input[name=username]").val('');
            $("#form_edit input[name=password]").val('');
            $("#form_edit input[name=email]").val('');
            $("#form_edit input[name=phone]").val('');
        },
        success: function (data) {
            $("#form_edit input[name=name]").val(data.siswa.name);
            $("#form_edit input[name=username]").val(data.siswa.username);
            $("#form_edit input[name=email]").val(data.siswa.email);
            $("#form_edit input[name=phone]").val(data.siswa.phone);
            $("#edit_siswa .submit").click(function () {
                edit_siswa(id);
            });
        },
        error: function (data) {
            $("#edit-error-bag").show();
            $('#edit-error').html('<li>Error loading data!</li>');
        }
    });
}

function edit_siswa(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/siswa/' + id,
        data: {
            name: $("#form_edit input[name=name]").val(),
            username: $("#form_edit input[name=username]").val(),
            password: $("#form_edit input[name=password]").val(),
            email: $("#form_edit input[name=email]").val(),
            phone: $("#form_edit input[name=phone]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_siswa .close").click();
            Swal.fire({
                title: 'Update Berhasil!',
                type: 'success',
                showConfirmButton: false,
            });
            setInterval(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            console.log(data.responseText);
            $('#edit-error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit-error').append('<li>' + value + '</li>');
            });
            $("#edit-error-bag").show();
        }
    });
}

function confirm_delete(id, nama) {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Menghapus "+nama+" !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            delete_siswa(id);
        }
    });
}

function delete_siswa(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/siswa/' + id,
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                title: 'Terhapus!',
                type: 'success',
                showConfirmButton: false,
            });
            setInterval(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            Swal.fire({
                title: 'Delete Gagal !',
                type: 'error',
                showConfirmButton: false,
            });
        }
    });
}
