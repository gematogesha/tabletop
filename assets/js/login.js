$(".choice-header-item").click(function (e) {
    e.preventDefault();
    $(".choice-header-item").removeClass('active-choice-item');
    $(this).addClass('active-choice-item');
});

$("#reg").click(function (e) {
    $(".choice-item-line").animate({
        marginLeft: '50%'
    }, "fast");
    $(".user-data").animate({
        marginLeft: '-100%'
    }, "fast");
});

$("#login").click(function (e) {
    $(".choice-item-line").animate({
        marginLeft: '0%'
    }, "fast");
    $(".user-data").animate({
        marginLeft: '0%'
    }, "fast");
});

$(".input-data-row").click(function (e) {
    e.stopPropagation();
    $(this).addClass('active-input-data');
    $(".input-data-row").not(this).removeClass('active-input-data');
});

$(".input-data-row").focusout(function () {
    $(".input-data-row").removeClass('active-input-data');
});


$('#login-submit').on('click', function (e) {
    $.ajax({
        url: 'include/login.php',
        type: 'POST',
        data: {
            login_submit: true,
            login: $('#login-ent').val(),
            password: $('#password-ent').val()
        },
        beforeSend: function () {
            $('#info-login').empty();
            $("#info-login").removeClass("alert");
            $("#info-login").removeClass("success");
        },
        success: function (responce) {
            $('#info-login').append(responce);
            console.log(responce.indexOf('Успешно!'));
            if(responce.indexOf('Успешно!') >= 0){                    
                $("#info-login").addClass("success");
                $("#info-login").fadeIn('fast').delay(1000).fadeOut('fast');
                setTimeout(function() {
                    window.location.href = "main.php?p=game";
                    }, 1600);
            }else{
                $("#info-login").addClass("alert");
                $("#info-login").fadeIn('fast').delay(2000).fadeOut('fast');
            }

        },
        error: function () {
            $("#info-login").append("<span>Проблема соединения с сервером</span>");
            $("#info-login").addClass("alert");
            $("#info-login").fadeIn('fast').delay(2000).fadeOut('fast');

        }
    });
});

$('#reg-submit').on('click', function (e) {
    $.ajax({
        url: 'include/login.php',
        type: 'POST',
        data: {
            reg_submit: true,
            login: $('#login-reg').val(),
            name: $('#name-reg').val(),
            password: $('#password-reg').val(),
            second_password: $('#second-password-reg').val()
        },
        beforeSend: function () {
            $('#info-reg').empty();
            $("#info-reg").removeClass("alert");
            $("#info-reg").removeClass("success");
        },
        success: function (responce) {
            $('#info-reg').append(responce);
            if((responce.indexOf('Успешно!') >= 0)){                    
                $("#info-reg").addClass("success");
                $("#info-reg").fadeIn('fast').delay(1000).fadeOut('fast');
                setTimeout(function() {
                    window.location.href = "main.php?p=profile";
                    }, 1600);
            }else{
                $("#info-reg").addClass("alert");
                $("#info-reg").fadeIn('fast').delay(2000).fadeOut('fast');
            }

        },
        error: function () {
            $("#info-reg").append("<span>Проблема соединения с сервером</span>");
            $("#info-reg").addClass("alert");
            $("#info-reg").fadeIn('fast').delay(2000).fadeOut('fast');

        }
    });
});