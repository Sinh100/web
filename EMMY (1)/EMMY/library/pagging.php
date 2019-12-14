<?php

function get_pagging($num_page, $page, $base_url = "",$id_loai) {
    $str_pagging = "<ul id='list-paging' class='fl-right'>";
    if($page > 1 && $num_page>1){
        $str_prev =  1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}&id=$id_loai\">|<</a></li>";
    }
    if($page > 1 && $num_page>1){
        $str_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}&id=$id_loai\"><</a></li>";
    }
    for($i = 1; $i <= $num_page; $i++){
        $active = "";
        if($i == $page){
            $active = "style='pointer-events: none;
    cursor: not-allowed; '";
            $str_pagging .= "<li $active><a style='background: white;    border: 1px solid; color:#222' href = \"{$base_url}&page={$i}&id=$id_loai\">{$i}</a></li>";
        }
        
        
    }
    if($page < $num_page && $num_page>1){
        $str_next = $page + 1;
        $str_pagging .= "<li><a style='font-size' href = \"{$base_url}&page={$str_next}&id=$id_loai\">></i></a></li>";
    }
    if($page < $num_page && $num_page>1){
        $str_prev =  $num_page;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}&id=$id_loai\">>|</a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}

function get_pagging_main($num_page, $page, $base_url = "") {
    $str_pagging = "<ul id='list-paging' class='fl-right'>";
     if($page > 1 && $num_page>1){
        $str_prev =  1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}\">|<</a></li>";
    }
    if($page > 1 && $num_page>1){
        $str_prev = $page - 1;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}\"><</a></li>";
    }
    for($i = 1; $i <= $num_page; $i++){
        $active = "";
        if($i == $page){
            $active = "style='pointer-events: none;
    cursor: not-allowed; '";
            $str_pagging .= "<li $active><a style='background: white;    border: 1px solid; color:#222' href = \"{$base_url}&page={$i}\">{$i}</a></li>";
        }
        
    }
    if($page < $num_page && $num_page>1){
        $str_next = $page + 1;
        $str_pagging .= "<li><a style='font-size' href = \"{$base_url}&page={$str_next}\">></i></a></li>";
    }
    if($page < $num_page && $num_page>1){
        $str_prev =  $num_page;
        $str_pagging .= "<li><a href = \"{$base_url}&page={$str_prev}\">>|</a></li>";
    }
    $str_pagging .= "</ul>";
    return $str_pagging;
}
?>