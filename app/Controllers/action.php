<?php
namespace app\Controllers;
use app\Controllers\Database as db;
$data = file_get_contents('php://input');
json_validator($data);
$data = json_decode($data);

$db = new db($data);
//dbInsert($data);

$config =  [

    "servername" => "'http://ilkaskh8.beget.tech",
    "database" => "ilkaskh8_inline",
    "username" => "ilkaskh8_inline",
    "password" => "*I0rMN5I"

];
//function dbInsert($data) use ($config){
//    $servername =$config->item('servername');
//    $username =$config->item('username');
//    $password =$config->item('password');
//    $database =$config->item('database');
//    $conn = new  mysqli_connect($servername, $username, $password, $database);
//
//    if ($conn->connect_error) {
//        file_put_contents('db.log','error_connect' . PHP_EOL,FILE_APPEND);
//    }
//    else{
//        file_put_contents('db.log','connected' . PHP_EOL,FILE_APPEND);
//    }
//    foreach ($data as $post){
//        file_put_contents('post.log',$post->userId . PHP_EOL,FILE_APPEND);
//        file_put_contents('post.log',$post->id . PHP_EOL,FILE_APPEND);
//        file_put_contents('post.log',$post->title . PHP_EOL,FILE_APPEND);
//        file_put_contents('post.log',$post->body . PHP_EOL,FILE_APPEND);
//        file_put_contents('post.log','///////////' . PHP_EOL,FILE_APPEND);
//    }
//}

function json_validator($data=NULL) {

    if (!empty($data)) {

        @json_decode($data);

        return (json_last_error() === JSON_ERROR_NONE);

    }
    return false;
}






