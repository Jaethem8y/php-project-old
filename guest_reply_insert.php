<?php
    session_start();
    $id = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
    $parent = $_GET['no'];
    $content = $_POST['re'];
    include 'dbconnect.php';
    date_default_timezone_set('Asia/Seoul');
    $date = date('Y/m/d h:i:s a',time());
    $sql = "insert into memo_reply(parent,id,name,content,regdate) values('$parent','$id','$name','$content','$date')";
    mysqli_query($connect,$sql);
    $sql = "set @count=0";
    mysqli_query($connect,$sql);
    $sql = "update memo set no = @count:=@count+1";
    mysqli_query($connect,$sql);
    echo "<script>location.href = 'guest.php';</script>";

?>