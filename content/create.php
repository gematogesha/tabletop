<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include("../include/config.php");
?><div class="wrap">

    <div class="input-data-row">
        <i class="fa-regular fa-calendar"></i>
        <input class="input-data" type="text" id="datepicker" placeholder="Выберите дату" autocomplete="off">
    </div>


</div>

<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/js/datapicker-rus.js" type="text/javascript"></script>

<script>
    $(function() {
        $("#datepicker").datepicker({
            minDate: 0
        });
    });

    $(".input-data-row").click(function(e) {
        e.stopPropagation();
        $(this).addClass('active-input-data');
        $(".input-data-row").not(this).removeClass('active-input-data');
    });

    $(".input-data-row").focusout(function() {
        $(".input-data-row").removeClass('active-input-data');
    });
</script>