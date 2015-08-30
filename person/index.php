<?php
    require_once("../db.php");
    require_once("functions.php");
 
    $link = db_connect();

    if(isset($_GET['action']))
        $action = $_GET['action'];
    else
        $action = "";

    $person = ['id'=>0, 'name'=>""];

    if($action == "add"){
        if(!empty($_POST)){
            add_person($link, $_POST['name'], $_POST['surname'], $_POST['birthday'], $_POST['phone'], $_POST['email'], $_POST['address']);
            $person = get_last_person($link);
            include ("../views/message.html");
        }
    }else 
        include ("../views/person_head.html");
?>