$(document).ready(function () {
    $('#add-error-bag').hide();
    $('#addP-error-bag').hide();
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
            setTimeout(() => {
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
            $("#form_edit input[name=team]").val('');
        },
        success: function (data) {
            $("#form_edit input[name=name]").val(data.siswa.name);
            $("#form_edit input[name=username]").val(data.siswa.username);
            $("#form_edit input[name=email]").val(data.siswa.email);
            $("#form_edit input[name=phone]").val(data.siswa.phone);
            $("#form_edit input[name=team]").val(data.siswa.team);
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
            team: $("#form_edit input[name=team]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_siswa .close").click();
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
            var errors = $.parseJSON(data.responseText);
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
        text: "Menghapus " + nama + " !",
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

function add_pertemuan() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan',
        data: {
            nama: $("#form_addP input[name=nama]").val(),
            judul: $("#form_addP input[name=judul]").val(),
            tanggal: $("#form_addP input[name=tanggal]").val(),
            kompetensi: $.trim($("#form_addP .kompetensi").val()),
            tujuan: $.trim($("#form_addP .tujuan").val()),
        },
        dataType: 'json',
        beforeSend: function () {
            $("#add_pertemuan .btn").attr("disabled", true);
            $("#add_pertemuan .btn").html('...');
        },
        success: function (data) {
            $("#add_pertemuan .close").click();
            Swal.fire({
                title: 'Berhasil ditambahkan!',
                type: 'success',
                showConfirmButton: false,
            });
            setTimeout(() => {
                window.location.reload();
            }, 500);
        },
        error: function (data) {
            $("#add_pertemuan .btn").attr("disabled", false);
            $("#add_pertemuan .btn").html('Add');
            console.log(data.responseText);
            var errors = $.parseJSON(data.responseText);
            $('#addP-error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#addP-error').append('<li>' + value + '</li>');
            });
            $("#addP-error-bag").show();
        }
    });
}

function fill_editP(id) {
    $.ajax({
        type: 'GET',
        url: '/admin/pertemuan/' + id + '/edit',
        beforeSend: function () {
            $('#editP-error-bag').hide();
            $("#form_editP input[name=nama]").val('');
            $("#form_editP input[name=judul]").val('');
            $("#form_editP input[name=tanggal]").val('');
            $("#form_editP .kompetensi").val('');
            $("#form_editP .tujuan").val('');
        },
        success: function (data) {
            $("#form_editP input[name=nama]").val(data.pertemuan.nama);
            $("#form_editP input[name=judul]").val(data.pertemuan.judul);
            $("#form_editP input[name=tanggal]").val(data.pertemuan.tanggal);
            $("#form_editP .kompetensi").val(data.pertemuan.kompetensi);
            $("#form_editP .tujuan").val(data.pertemuan.tujuan);
            $("#edit_pertemuan .submit").click(function () {
                edit_pertemuan(id);
            });
        },
        error: function (data) {
            $("#editP-error-bag").show();
            $('#editP-error').html('<li>Error loading data!</li>');
        }
    });
}

function edit_pertemuan(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/' + id + '/edit',
        data: {
            nama: $("#form_editP input[name=nama]").val(),
            judul: $("#form_editP input[name=judul]").val(),
            tanggal: $("#form_editP input[name=tanggal]").val(),
            kompetensi: $.trim($("#form_editP .kompetensi").val()),
            tujuan: $.trim($("#form_editP .tujuan").val()),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_pertemuan .close").click();
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
            var errors = $.parseJSON(data.responseText);
            $('#editP-error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#editP-error').append('<li>' + value + '</li>');
            });
            $("#editP-error-bag").show();
        }
    });
}

function confirm_deleteP(id, nama) {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Menghapus " + nama + " !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            delete_pertemuan(id);
        }
    });
}

function delete_pertemuan(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/' + id,
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

function acak_team() {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Mengacak team akan merefresh ulang seluruh team yang telah dibuat!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya Acak!',
        cancelButtonText: 'Tidak, Kembali',
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/admin/siswa/acak',
                data: {
                    jumlah: $("#form_team input[name=jumlah]").val(),
                    ajax: true,
                },
                dataType: 'json',
                success: function (data) {
                    $( "#form_team" ).submit();
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    if(errors.type == 1){
                        toastr.error(errors.messages.jumlah);
                    }else if(errors.type == 2){
                        toastr.error(errors.messages);
                    }

                }
            });
        }
    });
}
