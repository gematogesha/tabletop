$('.logout').on('click', function (e) {
$.ajax({
    url: 'include/logout.php',
    type: 'POST',
    success: function (responce) {
        if(responce.indexOf('Успешно!') >= 0){                    
            window.location.href = "index.html";
    }},
    error: function () {
        $(".body-block").append('<div class="status-info" style="display: block; color: var(--red)"><span>Проблема соединения с сервером</span></div>');
        console.log("load: error");

    }
    });
});