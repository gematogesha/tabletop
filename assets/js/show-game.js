
$(".game-list-item").click(function(e) {
    e.preventDefault();
    if($(this).children('.game-add-info').hasClass('show')){
        $(this).children('.game-add-info').removeClass('show');
        $(this).children('.game-add-info').hide('fast');
    }else{
        $(this).children('.game-add-info').addClass('show');
        $(this).children('.game-add-info').show('fast');
    }

});

