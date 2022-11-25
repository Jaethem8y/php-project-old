<?php
    echo "<script>alert('삭제하면 복구불가 삭제 진행?')</script>";
    $num = $_GET['num'];
    $page = $_GET['page'];
    $pageno=$_GET['pageno'];
    include 'dbconnect.php';
    if($_GET['page']=="board"){
        $sql = "delete from board where num = $num";
        $file1 = $_GET['file1'];
        $file2 = $_GET['file2'];
        $file3 = $_GET['file3'];
        if($file1 !=null){
            unlink("pics/".$file1);
        }
        if($file2 !=null){
            unlink("pics/".$file2);
        }
        if($file3 !=null){
            unlink("pics/".$file3);
        }
        mysqli_query($connect,$sql);
        $sql = "set @count=0";
        mysqli_query($connect,$sql);
        $sql = "update board set num = @count:=@count+1";
    }else{
        $sql = "delete from download where num = $num";
        $file1 = $_GET['file1'];
        $file2 = $_GET['file2'];
        $file3 = $_GET['file3'];
        if($file1 !=null){
            unlink("pics/".$file1);
        }
        if($file2 !=null){
            unlink("pics/".$file2);
        }
        if($file3 !=null){
            unlink("pics/".$file3);
        }
        mysqli_query($connect,$sql);
        $sql = "set @count=0";
        mysqli_query($connect,$sql);
        $sql = "update download set num = @count:=@count+1";
    }
   
    mysqli_query($connect,$sql);
    echo "<script>alert('삭제완료!')</script>";
    if($num-1%3==0){
        $pageno = $pageno-1;
    }
    if($pageno==0){
        $pageno=1;
    }
    echo "<script>location.href='board_list.php?page=$page&pageno=$pageno'</script>";

?>