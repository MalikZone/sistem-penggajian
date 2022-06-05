$("#cek-submit").click(function(e) {
    e.preventDefault();
    $.ajax({
        url: routes.cek_proses,
        method: 'post',
        data: {
            input1: $('#input1').val(),
            input2: $('#input2').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            $("#result").html(result.result + '/' + result.count_input_1 + ' = ' + result.percentage + '%');
        }
    });
});