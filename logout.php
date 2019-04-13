<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登出</title>
</head>
<body>

<?php
    session_start();
    session_destroy(); // 调用destroy将session销毁

    echo '<script type="text/javascript">
        window.location.href="login.html";
    </script>';
?>

</body>
</html>
