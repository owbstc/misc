<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改密码程序</title>
</head>
<body>

<?php
    session_start();
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $old_password = $_REQUEST['old_password'];

    $conn = mysqli_connect('localhost', 'root', 'root', 'test') or die(mysqli_connect_error());

    $query = $conn->query("select * from user2 where username='{$username}' limit 1;") or die(mysqli_error($conn));
    $row = $query->fetch_array();

    if (empty($row)) {
        echo '<script type="text/javascript">
            alert("用户名不存在");
            window.location.href="forgetpwd.html";
        </script>';
    } else {
        $db_username = $row['username'];
        $db_password = $row['password'];
        if ($db_password != $old_password) {
            echo '<script type="text/javascript">
                alert("旧密码错误");
                window.location.href="forgetpwd.html";
            </script>';
        } else {
            $query = $conn->query("update user2 set password='$password' where username='$username'") or die(mysqli_error($conn));
    
            echo '<script type="text/javascript">
                alert("密码修改成功");
                window.location.href="login.html";
            </script>';
        }
    }

    $conn->close();
?>

</body>
</html>
