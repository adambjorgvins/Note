<?php
/**
 * Created by PhpStorm.
 * User: AdamB
 * Date: 23.11.2016
 * Time: 20:20
 */
?>
<script>
    $(document).ready(function(){
        var current =window.location.pathname.replace(/\//g,'');
        $('.header a').removeClass('active')
        $('a[href="/'+current+'"]').addClass('active')

        $('ul.tabs').tabs();
    });
</script>
<div class="header">
    <ul class="tabs tabs-fixed-width z-depth-1">
        <li class="tab"><a target="_self" class="active" href="/translate" >TRANSLATE</a></li>
        <li class="tab"><a target="_self" href="/calendar">CALENDAR</a></li>
        <li class="tab"><a target="_self" href="/note">NOTE</a></li>
        <li class="tab"><a target="_self" href="/clock">CLOCK</a></li>
        <li class="tab"><a target="_self" href="/logout.php">LOGOUT</a></li>
        <div class="indicator" style="right: 1152px; left: 384px;"></div>
        <div class="indicator" style="right: 1152px; left: 384px;"></div>
    </ul>
</div>