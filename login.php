<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登陆程序</title>
</head>
<body>

<?php
    session_start(); // 登录系统开启一个session内容

    $username = $_REQUEST['username']; // 获取html中的用户名（通过post请求）
    $password = $_REQUEST['password']; // 获取html中的密码（通过post请求）

    $conn = mysqli_connect('localhost', 'root', 'root', 'test') or die(mysqli_connect_error());

    $query = $conn->query("select * from user2 where username='{$username}' limit 1;") or die(mysqli_error($conn));
    $row = $query->fetch_array(); // 将$query中的结果找出来

    if (empty($row)) { // 用户名在数据库中不存在时跳回login.html界面
        echo '<script type="text/javascript">
            alert("用户名不存在");
            window.location.href="login.html";
        </script>';
    } else {
        $db_username = $row['username'];
        $db_password = $row['password'];
        if ($db_password != $password) { // 当对应密码不对时跳回login.html界面
            echo '<script type="text/javascript">
                alert("密码错误");
                window.location.href="login.html";
            </script>';
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["code"] = mt_rand(0, 100000); // 给session附一个随机值，防止用户直接通过调用界面访问welcome.php
            echo '<script type="text/javascript">
                window.location.href="welcome.php";
            </script>';
        }
    }

    $conn->close(); // 关闭数据库连接，如不关闭，下次连接时会出错
?>

</body>
</html>
