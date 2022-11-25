<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        echo "<script>alert('로그인 해주세요!');</script>";
        echo "<script>history.back();</script>";
    }else{
        include 'dbconnect.php';
        $name = $_SESSION['user_name'];
        $id = $_SESSION['user_id'];
        $content = $_POST['ta'];
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y/m/d h:i:s a',time());
        $sql = "insert into memo(name,id,content,regdate) values ('$name','$id','$content','$date')";
        if(mysqli_query($connect,$sql)){
            
            $sql = "set @count=0";
            mysqli_query($connect,$sql);
            $sql = "update memo set no = @count:=@count+1";
            mysqli_query($connect,$sql);
            echo "<script>location.href='guest.php'</script>";
        }else{
            echo mysqli_error($connect);
        }
    }
?>