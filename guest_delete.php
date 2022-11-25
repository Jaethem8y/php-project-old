<?php
    $no = $_GET['no'];
    include 'dbconnect.php';
    $sql = "delete from memo where no = '$no'";
    mysqli_query($connect,$sql);
    $sql = "set @count=0";
    mysqli_query($connect,$sql);
    $sql = "update memo set no = @count:=@count+1";
    mysqli_query($connect,$sql);
    echo "<script>alert('삭제완료');</script>";
    echo "<script>location.href='guest.php'</script>";

?>