$('#create-game').on('click', function (e) {
    $.ajax({
        url: 'include/create-game.php',
        type: 'POST',
        data: {
            create_submit: true,
            type_game: $('#type-game').val(),
            name_game: $('#name-game').val(),
            description: $('#description').val(),
            date_game: $('#datepicker').val(),
            time_game: $('#timepicker').val(),
        },
        beforeSend: function () {
            $('#create-game').empty();
            $("#create-game").removeClass("alert-btn");
            $("#create-game").removeClass("success-btn");
        },
        success: function (responce) {
            $('#create-game').append(responce);
            console.log(responce.indexOf('Успешно!'));
            if(responce.indexOf('Успешно!') >= 0){                    
                $("#create-game").addClass("success-btn");
                $("#create-game").fadeIn('fast').delay(1000).fadeOut('fast');
                setTimeout(function() {
                    location.reload();
                    }, 1600);
            }else{
                $("#create-game").addClass("alert-btn");
                $("#create-game").fadeIn('fast').delay(2000).fadeOut('fast');
                setTimeout(function() {
                    $("#create-game").removeClass("alert-btn").empty().append('Создать игру').prop('disabled', false).fadeIn('fast');
                }, 3000);
            }

        },
        error: function () {
            $("#create-game").append("<span>Проблема соединения с сервером</span>");
            $("#create-game").prop('disabled', true).addClass("alert-btn").fadeIn('fast').delay(2000).fadeOut('fast');
            setTimeout(function() {
                $("#create-game").removeClass("alert-btn").empty().append('Создать игру').prop('disabled', false).fadeIn('fast');
            }, 3000);
            


        }
    });
});