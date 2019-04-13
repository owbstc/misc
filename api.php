<?php

$c = !empty($_REQUEST['c']) ? $_REQUEST['c'] : '';
$a = !empty($_REQUEST['a']) ? $_REQUEST['a'] : '';

if (empty($c)) {
    echo '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style>
        <div style="padding: 24px 48px;"> 
            <h1>:) 2019新年快乐</h1>
                <p> Api V0.1<br/>
                    <span style="font-size:30px">不断开拓、学习、积累、沉淀 - Laucw</span>
                </p>
        </div>';
} else {
    if (!class_exists($c)) {
        echo "Class '$c' not found";
    } else {
        if (empty($a)) {
            $a = 'index';
        }

        if (!method_exists((new $c), $a)) {
            echo "Call to undefined method {$c}::{$a}()";
        } else {
            (new $c)->$a();
        }
    }
}

class Userinfo {

    public function index() {
        echo 'index';
    }

    public function getUsername() {
        session_start();
        $username = $_SESSION['username'];

        $response['code'] = 200;
        $response['msg'] = 'OK';
        $response['data']['username'] = $username;
    
        echo json_encode($response);
    }

}
