<?php
    $no =  $_GET['no'];
    include 'dbconnect.php';
    $sql = "delete from memo_reply where no = '$no'";
    mysqli_query($connect,$sql);
    $sql = "set @count=0";
    mysqli_query($connect,$sql);
    $sql = "update memo set no = @count:=@count+1";
    mysqli_query($connect,$sql);
    echo "<script>location.href = 'guest.php';</script>";

    
?>