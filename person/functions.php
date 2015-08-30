<?php

function add_person($link, $name, $surname, $birthday, $phone, $email, $address){
    $name = trim($name);
    $surname = trim($surname);
    $phone = trim($phone);
    $email = trim($email);
    $address = trim($address);
    
    if($name == "") return false;
    
    $sql = "INSERT INTO person (name, surname, birthday, phone, email, address) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
    
    $query = sprintf($sql, mysqli_real_escape_string($link, $name),
                    mysqli_real_escape_string($link, $surname),
                    mysqli_real_escape_string($link, $birthday),
                    mysqli_real_escape_string($link, $phone),
                    mysqli_real_escape_string($link, $email),
                    mysqli_real_escape_string($link, $address));
    
    $result = mysqli_query($link, $query);
    
    if(!$result)
        die(mysqli_error($link));
    
    return true;
}

function get_last_person($link){
    $query = "SELECT id, name FROM person WHERE `id`=(SELECT MAX(id) FROM person)";
    $result = mysqli_query($link, $query);
    
    if(!$result)
        die(mysqli_error($link));

    return mysqli_fetch_assoc($result);
}

function all_person($link){
    $query = "SELECT * FROM person ORDER BY id DESC";
    $result = mysqli_query($link, $query);
    
    if(!$result)
        die(mysqli_error($link));
    
    // Извлечение из запроса
    $n = mysqli_num_rows($result);
    $articles = array();
    
    for($i=0; $i < $n; $i++){
        $row = mysqli_fetch_assoc($result);
        $articles[] = $row;
    }
    return true;
}
?>