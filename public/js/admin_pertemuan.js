$(document).ready(function () {
    $('#add_detail_error_bag').hide();
    $('#add_kegiatan_error_bag').hide();
    $('#table_presensi').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
});

function hadir(id, hadir) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/hadir',
        data: {
            id: id,
            kehadiran: hadir
        },
        dataType: 'json',
        beforeSend: function (data) {
            $("#btn_hadir" + id).removeClass('btn-success btn-danger').addClass('btn-warning');
            $("#icon_hadir" + id).removeClass('fa-check').addClass('fa-spinner text-white');
        },
        success: function (data) {
            $("#td_hadir" + id).html(data.replace);
        },
        error: function (data) {
            // var errors = $.parseJSON(data.responseText);
            // $("#ajax"+id).html(errors.error);
            $("#icon_hadir" + id).removeClass('fa-spinner').addClass('fa-exclamation-triangle');
            setTimeout(function () {
                if (hadir) {
                    $("#btn_hadir" + id).removeClass('btn-warning').addClass('btn-success');
                    $("#icon_hadir" + id).removeClass('fa-exclamation-triangle').addClass('fa-check');
                } else {
                    $("#btn_hadir" + id).removeClass('btn-warning').addClass('btn-danger');
                    $("#icon_hadir" + id).removeClass('fa-exclamation-triangle').addClass('fa-times');
                }
            }, 1500);

        }
    });
}

function add_detail(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/detail',
        data: {
            id_pertemuan: $("#form_add_detail input[name=id_pertemuan]").val(),
            kegiatan: $("#form_add_detail input[name=kegiatan]").val(),
            mulai: $("#form_add_detail input[name=mulai]").val(),
            selesai: $("#form_add_detail input[name=selesai]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_detail .close").click();
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
            $('#add_detail_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add_detail_error').append('<li>' + value + '</li>');
            });
            $("#add_detail_error_bag").show();
        }
    });
}

function fill_edit_detail(id) {
    $.ajax({
        type: 'GET',
        url: '/admin/pertemuan/detail/' + id,
        beforeSend: function () {
            $("#edit_detail_error_bag").hide();
            $("#form_edit_detail input[name=kegiatan]").val('');
            $("#form_edit_detail input[name=mulai]").val('');
            $("#form_edit_detail input[name=selesai]").val('');
        },
        success: function (data) {
            $("#form_edit_detail input[name=kegiatan]").val(data.detail.kegiatan);
            $("#form_edit_detail input[name=mulai]").val(data.detail.mulai);
            $("#form_edit_detail input[name=selesai]").val(data.detail.selesai);
            $("#edit_detail .submit").click(function () {
                edit_detail(id);
            });
        },
        error: function (data) {
            $('#edit_detail_error').html('<li>Error loading data!</li>');
            $("#edit_detail_error_bag").show();
        }
    });
}

function edit_detail(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/detail/' + id ,
        data: {
            kegiatan: $("#form_edit_detail input[name=kegiatan]").val(),
            mulai: $("#form_edit_detail input[name=mulai]").val(),
            selesai: $("#form_edit_detail input[name=selesai]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_detail .close").click();
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
            $('#edit_detail_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_detail_error').append('<li>' + value + '</li>');
            });
            $("#edit_detail_error_bag").show();
        }
    });
}

function confirm_delete_detail(id, nama) {
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
            delete_detail(id);
        }
    });
}

function delete_detail(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/detail/' + id,
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
                timer: 1000
            });
        }
    });
}

function show_modal_add_kegiatan(id_detail, nama){
    $("#add_kegiatan .modal-title").html("Tambah deksripsi kegiatan : <b class='text-primary'>"+nama+"</b>");
    $("#form_add_kegiatan input[name=id_detail]").val(id_detail);
    $("#form_add_kegiatan input[name=teks]").val('');
    $('#add_kegiatan').modal('show');
}

function add_kegiatan(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/detail/kegiatan',
        data: {
            id_detail: $("#form_add_kegiatan input[name=id_detail]").val(),
            teks: $("#form_add_kegiatan input[name=teks]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_kegiatan .close").click();
            Swal.fire({
                title: 'Berhasil ditambahkan!',
                type: 'success',
                showConfirmButton: false,
                timer: 700,
            });
            id_detail = $("#form_add_kegiatan input[name=id_detail]").val();
            $("#detail_kegiatan"+id_detail).html(data.append);
        },
        error: function (data) {
            console.log(data.responseText);
            var errors = $.parseJSON(data.responseText);
            $('#add_kegiatan_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add_kegiatan_error').append('<li>' + value + '</li>');
            });
            $("#add_kegiatan_error_bag").show();
        }
    });
}

function show_modal_edit_kegiatan(id, nama){
    $("#edit_kegiatan .modal-title").html("Edit deksripsi kegiatan : <b class='text-primary'>"+nama+"</b>");
    $.ajax({
        type: 'GET',
        url: '/admin/pertemuan/detail/kegiatan/' + id,
        beforeSend: function () {
            $("#edit_kegiatan_error_bag").hide();
            $("#form_edit_kegiatan input[name=teks]").val('');
        },
        success: function (data) {
            $("#form_edit_kegiatan input[name=teks]").val(data.kegiatan.teks);
            $('#edit_kegiatan .submit').off('click'); //! Clear INHERITED JQUERY CLICK
            $("#edit_kegiatan .submit").click(function () {
                edit_kegiatan(id);
            });

        },
        error: function (data) {
            $('#edit_kegiatan_error').html('<li>Error loading data!</li>');
            $("#edit_kegiatan_error_bag").show();
        }
    });
    $('#edit_kegiatan').modal('show');
}

function edit_kegiatan(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/detail/kegiatan/' + id ,
        data: {
            teks: $("#form_edit_kegiatan input[name=teks]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_kegiatan .close").click();
            Swal.fire({
                title: 'Update Berhasil!',
                type: 'success',
                showConfirmButton: false,
                timer: 700
            });
            $("#detail_kegiatan"+data.id_detail).html(data.append);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#edit_kegiatan_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_kegiatan_error').append('<li>' + value + '</li>');
            });
            $("#edit_kegiatan_error_bag").show();
        }
    });
}

function confirm_delete_kegiatan(id, nama) {
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
            delete_kegiatan(id);
        }
    });
}

function delete_kegiatan(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/detail/kegiatan/' + id,
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                title: 'Terhapus!',
                type: 'success',
                showConfirmButton: false,
                timer: 700
            });
            $("#detail_kegiatan"+data.id_detail).html(data.append);
        },
        error: function (data) {
            Swal.fire({
                title: 'Delete Gagal !',
                type: 'error',
                showConfirmButton: false,
                timer: 700
            });
        }
    });
}
