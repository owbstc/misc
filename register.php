<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册程序</title>
</head>
<body>

<?php
    session_start();

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $conn = mysqli_connect('localhost', 'root', 'root', 'test') or die(mysqli_connect_error());

    $query = $conn->query("select * from user2 where username='{$username}' limit 1;") or die(mysqli_error($conn));
    $row = $query->fetch_array();

    if (!empty($row)) {
        echo '<script type="text/javascript">
            alert("用户名已存在");
            window.location.href="login.html";
        </script>';
    } else {
        $query = $conn->query("insert into user2 (username, password, create_at) values('$username', '$password', " . time() . ")") or die(mysqli_error($conn));

        echo '<script type="text/javascript">
            alert("注册成功");
            window.location.href="login.html";
        </script>';
    }

    $conn->close();
?>

</body>
</html>
