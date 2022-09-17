$(".bot-menu-item").click(function(e) {
    e.preventDefault();
    $('.active-bot-menu').not(this).children('span').hide('fast');
    $('.bot-menu-item').not(this).removeClass('active-bot-menu');
    $(this).addClass('active-bot-menu');
    $(this).children('span').show('fast');

    $.ajax({
        url: 'assets/js/content.js',
        dataType: "script",
        success: console.log("script load"),
        });
});


$(window).on('load', function() {
    $('body').addClass('loaded_hiding');
    window.setTimeout(function() {
        $('body').addClass('loaded');
        $('body').removeClass('loaded_hiding');
    }, 500);
})


$(".bot-menu-item").focusout(function() {
    $(".bot-menu-item").removeClass('active-bot-menu');
});

setTimeout(function (e) {
    $('#' + session).addClass('active-bot-menu');
    $('.active-bot-menu span').css('display','inline');
});


