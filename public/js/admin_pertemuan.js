$(document).ready(function () {
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
        url: '/admin/hadir',
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
