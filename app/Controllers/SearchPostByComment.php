<?php

$data = file_get_contents('php://input');

json_validator($data);

$data = json_decode($data);

$pathToLogs = dirname( __FILE__, 2 ) . '/Storage/logs/db-serachPostsByComment.log';
file_put_contents($pathToLogs, $_GET["comment"] .'||'. date('l jS \of F Y h:i:s A') . PHP_EOL,FILE_APPEND);

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

    $comment = $_GET["comment"];

        $request = "SELECT * FROM `comments` WHERE `body` LIKE '%$comment%'";
        $result = $mysqli->query($request);
        $response = [];
        if( $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                array_push($response,[
                    'postId'=>$row["postId"],
                    'commentId'=>$row["id"],
                    'commentBody'=>$row["body"]
                ]);
            }
        }



        else{
            file_put_contents($pathToLogs, "0 posts" . PHP_EOL,FILE_APPEND);
        }

        echo json_encode($response);

function json_validator($data=NULL) {

    if (!empty($data)) {

        @json_decode($data);

        return (json_last_error() === JSON_ERROR_NONE);

    }
    return false;
}