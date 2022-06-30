setTimeout(function (e) {
    if($('.active-bot-menu').attr('id') == 'game'){
        $('title').text('Игры');
    }else if($('.active-bot-menu').attr('id') == 'profile'){
        $('title').text('Профиль');      
    }else if($('.active-bot-menu').attr('id') == 'create'){
        $('title').text('Создать игру');      
    }

    function setLocation(curLoc){
        try {
          history.pushState(null, null, curLoc);
          return;
        } catch(e) {}
        location.hash = '#' + curLoc;
        alert(curLoc);
    }


    setLocation('main.php?p=' + $('.active-bot-menu').attr('id'));
    
    $.ajax({
        url: 'content/' + $('.active-bot-menu').attr('id') + '.php',
        type: 'POST',
        beforeSend: function () {
            $('.body-block').empty();
        },
        success: function (responce) {
            $('.body-block').append(responce).show('fast'); 
            console.log("load: success");
        },
        error: function () {
            $(".body-block").append('<div class="status-info" style="display: block; color: var(--red)"><span>Проблема соединения с сервером</span></div>');
            console.log("load: error");

        }
    });
});
