<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>欢迎登录界面</title>
</head>
<body>

<?php
    session_start();

    if (isset($_SESSION["code"])) { // 判断code存不存在，如果不存在，说明异常登录
        echo "欢迎登录：{$_SESSION['username']}<br>
            您的IP：{$_SERVER['REMOTE_ADDR']}<br>
            您的语言：{$_SERVER['HTTP_ACCEPT_LANGUAGE']}<br>
            浏览器版本：{$_SERVER['HTTP_USER_AGENT']}<br>
            <a href=\"logout.php\">退出登录</a><br>
            <a href=\"forgetpwd.html\">修改密码</a>";
    } else { // code不存在，调用 logout.php 退出登录
        echo '<script type="text/javascript">
            alert("退出登录");
            window.location.href="logout.php";
        </script>';
    }
?>

</body>
</html>
