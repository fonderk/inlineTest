<?php

$data = file_get_contents('php://input');

json_validator($data);

$data = json_decode($data);

insertComments($data);

$pathToLogs = dirname( __FILE__, 2 ) . '/Storage/logs/db-comments.log';

function insertComments($data){

    $servername ="localhost";
    $username ="ilkaskh8_inline";
    $password ="*I0rMN5I";
    $database ="ilkaskh8_inline";

    $mysqli =  new mysqli($servername, $username, $password, $database);

    if ($mysqli->connect_errno) {
        file_put_contents($pathToLogs,'error_connect' . PHP_EOL,FILE_APPEND);
        return false;
    }
    else{
        file_put_contents($pathToLogs,'connected' . PHP_EOL,FILE_APPEND);
    }


    foreach ($data as $post){
        $request = "INSERT INTO comments ".
            "(id, postId, name, email, body) "."VALUES ".
            "('$post->id','$post->postId','$post->name','$post->email','$post->body')";

        if($mysqli->query($request) === TRUE){
            file_put_contents($pathToLogs, "success", mysqli_error($mysqli) . PHP_EOL,FILE_APPEND);
        }
        else{
            file_put_contents($pathToLogs, "error: %s\n", mysqli_error($mysqli) . PHP_EOL,FILE_APPEND);
        }
    }
}

function json_validator($data=NULL) {

    if (!empty($data)) {

        @json_decode($data);

        return (json_last_error() === JSON_ERROR_NONE);

    }
    return false;
}