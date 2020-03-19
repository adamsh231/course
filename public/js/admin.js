$(document).ready(function () {
    $('#add-error-bag').hide();
    $('#status').hide();
    $('#siswa_table').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
});
function add() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/admin/add/siswa',
        data: {
            name: $("#form_add input[name=name]").val(),
            username: $("#form_add input[name=username]").val(),
            password: $("#form_add input[name=password]").val(),
            email: $("#form_add input[name=email]").val(),
            phone: $("#form_add input[name=phone]").val(),
        },
        dataType: 'json',
        success: function (data) {
            $('#btn_close_modal_add').click();
            $('#status').show();
            $('#status').append("Data Siswa Berhasil Diinputkan");
            setInterval(() => {
                window.location.reload();
            }, 1500);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('#add-task-errors').html('');
            $.each(errors.messages, function (key, value) {
                $('#add-task-errors').append('<li>' + value + '</li>');
            });
            $("#add-error-bag").show();
        }
    });
}
