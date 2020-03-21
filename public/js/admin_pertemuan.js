$(document).ready(function () {
    $('#add_detail_error_bag').hide();
    $('#add_kegiatan_error_bag').hide();
    $('#add_video_error_bag').hide();
    $('#add_kuis_error_bag').hide();
    $('#add_soal_error_bag').hide();
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
            setTimeout(() => {
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
            setTimeout(() => {
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

function add_video(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/video',
        data: {
            id_pertemuan: $("#form_add_video input[name=id_pertemuan]").val(),
            nama: $("#form_add_video input[name=nama]").val(),
            deskripsi: $.trim($("#form_add_video .deskripsi").val()),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_video .close").click();
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
            $('#add_video_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add_video_error').append('<li>' + value + '</li>');
            });
            $("#add_video_error_bag").show();
        }
    });
}

function fill_edit_video(id) {
    $.ajax({
        type: 'GET',
        url: '/admin/pertemuan/video/' + id,
        beforeSend: function () {
            $("#edit_video_error_bag").hide();
            $("#form_edit_video input[name=nama]").val('');
            $("#form_edit_video .deskripsi").val('');
        },
        success: function (data) {
            $("#form_edit_video input[name=nama]").val(data.video.nama);
            $("#form_edit_video .deskripsi").val(data.video.deskripsi);
            $("#edit_video .submit").click(function () {
                edit_video(id);
            });
        },
        error: function (data) {
            $('#edit_video_error').html('<li>Error loading data!</li>');
            $("#edit_video_error_bag").show();
        }
    });
}

function edit_video(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/video/' + id ,
        data: {
            nama: $("#form_edit_video input[name=nama]").val(),
            deskripsi: $.trim($("#form_edit_video .deskripsi").val()),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_video .close").click();
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
            $('#edit_video_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_video_error').append('<li>' + value + '</li>');
            });
            $("#edit_video_error_bag").show();
        }
    });
}

function confirm_delete_video(id, nama) {
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
             delete_video(id);
        }
    });
}

function delete_video(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/video/' + id,
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

function add_kuis(id_pertemuan){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/kuis',
        data: {
            id_pertemuan: id_pertemuan,
            nama: $("#form_add_kuis input[name=nama]").val(),
            waktu: $.trim($("#form_add_kuis input[name=waktu]").val()),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_kuis .close").click();
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
            $('#add_kuis_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add_kuis_error').append('<li>' + value + '</li>');
            });
            $("#add_kuis_error_bag").show();
        }
    });
}

function fill_edit_kuis(id, nama, waktu) {
    $("#edit_kuis_error_bag").hide();
    $("#form_edit_kuis input[name=nama]").val(nama);
    $("#form_edit_kuis input[name=waktu]").val(waktu);
    $('#edit_kuis').modal('show');
    $("#edit_kuis .submit").click(function () {
        edit_kuis(id);
    });
}

function edit_kuis(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/kuis/' + id ,
        data: {
            nama: $("#form_edit_kuis input[name=nama]").val(),
            waktu: $("#form_edit_kuis input[name=waktu]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_kuis .close").click();
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
            $('#edit_kuis_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_kuis_error').append('<li>' + value + '</li>');
            });
            $("#edit_kuis_error_bag").show();
        }
    });
}

function confirm_delete_kuis(id, nama) {
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
            delete_kuis(id);
        }
    });
}

function delete_kuis(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/kuis/' + id,
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

function add_soal(id_kuis){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/kuis/soal',
        data: {
            id_kuis: id_kuis,
            pertanyaan: $.trim($("#form_add_soal .pertanyaan").val()),
            A: $("#form_add_soal input[name=A]").val(),
            B: $("#form_add_soal input[name=B]").val(),
            C: $("#form_add_soal input[name=C]").val(),
            D: $("#form_add_soal input[name=D]").val(),
            jawaban: $("#form_add_soal .select").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#add_soal .close").click();
            Swal.fire({
                title: 'Berhasil ditambahkan!',
                type: 'success',
                showConfirmButton: false,
                timer: 700
            });
            $("#form_add_soal .pertanyaan").val('');
            $("#form_add_soal input[name=A]").val('');
            $("#form_add_soal input[name=B]").val('');
            $("#form_add_soal input[name=C]").val('');
            $("#form_add_soal input[name=D]").val('');
            $("#form_add_soal .select").val('A');
            $('#table_soal').html(data.append);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#add_soal_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#add_soal_error').append('<li>' + value + '</li>');
            });
            $("#add_soal_error_bag").show();
        }
    });
}

function fill_edit_soal(id){
    $('#edit_soal').modal('show');
    $.ajax({
        type: 'GET',
        url: '/admin/pertemuan/kuis/soal/' + id,
        beforeSend: function () {
            $("#edit_soal_error_bag").hide();
            $("#form_edit_soal .pertanyaan").val('');
            $("#form_edit_soal input[name=A]").val('');
            $("#form_edit_soal input[name=B]").val('');
            $("#form_edit_soal input[name=C]").val('');
            $("#form_edit_soal input[name=D]").val('');
            $("#form_edit_soal select").val('A');
        },
        success: function (data) {
            $("#form_edit_soal .pertanyaan").val(data.soal.pertanyaan);
            $("#form_edit_soal input[name=A]").val(data.soal.A);
            $("#form_edit_soal input[name=B]").val(data.soal.B);
            $("#form_edit_soal input[name=C]").val(data.soal.C);
            $("#form_edit_soal input[name=D]").val(data.soal.D);
            $("#form_edit_soal select").val(data.soal.jawaban);
            $('#edit_soal .submit').off('click');
            $("#edit_soal .submit").click(function () {
                edit_soal(id);
            });
        },
        error: function (data) {
            $('#edit_soal_error').html('<li>Error loading data!</li>');
            $("#edit_soal_error_bag").show();
        }
    });
}

function edit_soal(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'PUT',
        url: '/admin/pertemuan/kuis/soal/' + id ,
        data: {
            id: id,
            pertanyaan: $.trim($("#form_edit_soal .pertanyaan").val()),
            A: $("#form_edit_soal input[name=A]").val(),
            B: $("#form_edit_soal input[name=B]").val(),
            C: $("#form_edit_soal input[name=C]").val(),
            D: $("#form_edit_soal input[name=D]").val(),
            jawaban: $("#form_edit_soal .select").val(),
        },
        dataType: 'json',
        success: function (data) {
            $("#edit_soal .close").click();
            Swal.fire({
                title: 'Update Berhasil!',
                type: 'success',
                showConfirmButton: false,
                timer: 700,
            });
            $("#form_edit_soal .pertanyaan").val('');
            $("#form_edit_soal input[name=A]").val('');
            $("#form_edit_soal input[name=B]").val('');
            $("#form_edit_soal input[name=C]").val('');
            $("#form_edit_soal input[name=D]").val('');
            $("#form_edit_soal .select").val('A');
            $('#table_soal').html(data.append);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#edit_soal_error').html('Error!');
            $.each(errors.messages, function (key, value) {
                $('#edit_soal_error').append('<li>' + value + '</li>');
            });
            $("#edit_soal_error_bag").show();
        }
    });
}

function confirm_delete_soal(id, pertanyaan) {
    Swal.fire({
        title: 'Apa anda yakin?',
        text: "Menghapus "+pertanyaan+" !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            delete_soal(id);
        }
    });
}

function delete_soal(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '/admin/pertemuan/kuis/soal/' + id,
        dataType: 'json',
        success: function (data) {
            Swal.fire({
                title: 'Terhapus!',
                type: 'success',
                showConfirmButton: false,
                timer: 700
            });
            $('#table_soal').html(data.append);
        },
        error: function (data) {
            console.log(data.responseText);
            Swal.fire({
                title: 'Delete Gagal !',
                type: 'error',
                showConfirmButton: false,
                timer: 700
            });
        }
    });
}

function aktivasi(id, aktif) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/pertemuan/kuis/aktivasi/'+ id,
        data: {
            id: id,
            aktif: aktif
        },
        dataType: 'json',
        beforeSend: function (data) {
            $("#btn_aktif").removeClass('btn-success btn-danger').addClass('btn-warning');
            $("#btn_aktif").html('...');
        },
        success: function (data) {
            $("#block_button").html(data.replace);
        },
        error: function (data) {
            $("#btn_aktif").removeClass('btn-warning').addClass('btn-dark');
            $("#btn_aktif").html('Error!');
            setTimeout(function () {
                if (aktif) {
                    $("#btn_aktif").removeClass('btn-dark').addClass('btn-success');
                    $("#btn_aktif").html('Matikan Kuis');
                }else{
                    $("#btn_aktif").removeClass('btn-dark').addClass('btn-danger');
                    $("#btn_aktif").html('Aktifkan Kuis');
                }
            }, 1500);

        }
    });
}
