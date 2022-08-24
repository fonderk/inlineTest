<?php
header('Content-Type: application/json');

    $servername ="localhost";
    $username ="ilkaskh8_inline";
    $password ="*I0rMN5I";
    $database ="ilkaskh8_inline";

    $pathToLogs = dirname( __FILE__, 2 ) . '/Storage/logs/db-getPosts.log';
    $mysqli =  new mysqli($servername, $username, $password, $database);

    if ($mysqli->connect_errno) {
        file_put_contents($pathToLogs,'error_connect' . PHP_EOL,FILE_APPEND);
        return false;
    }
    else{
        file_put_contents($pathToLogs,'connected' . PHP_EOL,FILE_APPEND);
    }
    $request = null;

        $request = "SELECT * FROM post";
        $result = $mysqli->query($request);
        $response = [];
        if( $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                array_push($response,['id'=>$row["id"],
                    'userId'=>$row["userId"],
                    'title'=>$row["title"],
                    'body'=>$row["body"],
                    ]);
//                file_put_contents($pathToLogs, "id: " . $row["id"] . PHP_EOL,FILE_APPEND);
            }
        }
        else{
            file_put_contents($pathToLogs, "0 posts" . PHP_EOL,FILE_APPEND);
        }

    echo json_encode($response);
//    return json_encode($response);


