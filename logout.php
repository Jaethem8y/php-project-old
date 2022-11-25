<?php
    session_start();
    $res = session_destroy();
    if($res){
        echo "<script>alert('로그아웃 성공');</script>";
        echo "<script> location.href = 'main.php';</script>";
    }
?>