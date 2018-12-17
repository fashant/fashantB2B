<?php

header('Access-Control-Allow-Origin: https://m.demofashant.com', false);


if(isset($_POST['pagination']) && isset($_POST['selected']) && isset($_POST['func'])){
    $max_adverts = 10;
    $max_pag = 5;
    $num = $_POST['pagination'];
    $selected = $_POST['selected'];
    $func = $_POST['func'];

    if(!isset($selected)){
        $selected = 1;
    }

    // Total links
    $links = round($num/$max_adverts);
    if($links < ($num/$max_adverts)){
        $links++;
    }

    // Max pages with adverts
    $MAX_PAGES = $links;

    // Next ten number
    $next_ten = (ceil($selected / $max_pag) * $max_pag) + 1;

    if($next_ten < $links){
        $links = $next_ten;
    }

    // Set start of pagination
    if($max_adverts - intval($selected) < $max_pag){
        //$start = $links - ($MAX_PAGES - intval($selected));
        $start = (floor($selected/$max_pag) * $max_pag) + 1;
    } else {
        $start = $links - $max_pag;
    }

    // Set next pagination button
    if($links+1 > $MAX_PAGES){
        $next = intval($selected) + 1;
    } else {
        $next = $links;
    }

    // Set prev pagination button
    if(intval($selected) <= $max_pag && intval($selected) > 1){
        $prev = intval($selected) - 1;
    } else {
        $prev = floor($selected/$max_pag) * $max_pag;

        if(intval($selected % $max_pag) === 0){
            $prev--;
        }
    }

    echo "<ul class='pagination bootpag'>";

    if($prev >= 1) {
        echo "<li class='prev'><a onclick='$func(\"page\", {$prev}, {$selected});'>«</a></li>";
    } else {
        echo "<li class='disabled'><a>«</a></li>";

    }

    if($start <= 0){
        $start = 1;
    }


    if($links !== $num){
        if(intval($selected % $max_pag) === 0){
            $links = $links + $max_pag;
        }
    }

    if($num < $max_adverts){
        $links = 1;
    }

    for($i = $start; $i < $links; $i++){
        if($i === 1){
            if(strcmp($selected, "") === 0){
                echo "<li class='active'><a>{$i}</a></li>";
            }
        } else {
            if (strcmp($i, $selected) === 0) {
                echo "<li class='active'><a>{$i}</a></li>";
            } else {
                echo "<li><a class='waves-effect' onclick='$func(\"page\", {$i}, {$selected});'>{$i}</a></li>";
            }
        }
    }


    if($next < $MAX_PAGES){
        echo "<li class='next'><a onclick='$func(\"page\", {$next}, {$selected});'>»</a></li>";
    } else {
        echo "<li class='disabled'><a>»</a></li>";
    }

    echo "</ul>";
}