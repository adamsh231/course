$(document).ready(function () {
    $('#nilai_table').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
});

function fill_edit_nilai(id, nama, kuis, nilai) {
    $("#edit_nilai_error_bag").hide();
    $("#form_edit_nilai input[name=nama]").val(nama);
    $("#form_edit_nilai input[name=nilai]").val(nilai);
    $('#edit_nilai .submit').off('click');
    $("#edit_nilai .submit").click(function () {
        edit_nilai(id);
    });
}

function edit_nilai(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/nilai/' + id,
        data: {
            nilai: $("#form_edit_nilai input[name=nilai]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_nilai .close").click();
            Swal.fire({
                title: 'Update Berhasil!',
                type: 'success',
                showConfirmButton: false,
            });
            setTimeout(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            console.log(data.responseText);
            var errors = $.parseJSON(data.responseText);
            $('#edit_nilai_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_nilai_error').append('<li>' + value + '</li>');
            });
            $("#edit_nilai_error_bag").show();
        }
    });
}

function confirm_delete_nilai(id, nama, kuis) {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Hapus " + nama + " pada " + kuis + " !",
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
        url: '/admin/nilai/' + id,
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                title: 'Terhapus!',
                type: 'success',
                showConfirmButton: false,
            });
            setTimeout(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            Swal.fire({
                title: 'Delete Gagal !',
                type: 'error',
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
}
