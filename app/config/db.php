<?php

namespace config\db;

class db{
    public function connect(){

        $servername =$this->config->item('servername');
        $username =$this->config->item('username');
        $password =$this->config->item('password');
        $database =$this->config->item('database');
        $conn = new  mysqli_connect($servername, $username, $password, $database);

        if ($conn->connect_error) {
            file_put_contents('db.log','error_connect' . PHP_EOL,FILE_APPEND);
        }
        else{
            file_put_contents('db.log','connected' . PHP_EOL,FILE_APPEND);
        }
    }
    public function query($query){
        $conn = self::connect();
        mysqli_query($conn,$query);
    }

    public function disconnect($conn){
        mysqli_close($conn);
    }

}

