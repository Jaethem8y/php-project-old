<?php
    session_start();
    include 'dbconnect.php';
    $page = $_GET['page'];
    if(isset($_GET['num'])){
        $num = $_GET['num'];
        $pageno = $_GET['pageno'];
    }
        $path = 'pics/';
        if(isset($_POST['file1'])){
            $f1 = null;
            $file1 = $_GET['file1'];
            unlink($path.$file1);
            $sql;
            if($page=="board"){
                $sql = "update board set filename_0 = null where num = $num";
            }else{
                $sql = "update download set filename_0 = null where num = $num";
                mysqli_query($connect,$sql);  
                $sql = "update download set file_type0 = null where num = $num";
                echo "yeas";
            }
            mysqli_query($connect,$sql);            
        }
        if(isset($_POST['file2'])){
            $f2 = null;
            $file2 = $_GET['file2'];
            unlink($path.$file2);
            $sql;
            if($page=="board"){
                $sql = "update board set filename_1 = null where num = $num";
            }else{
                $sql = "update download set filename_1 = null where num = $num";
                mysqli_query($connect,$sql);  
                $sql = "update download set file_type1 = null where num = $num";
            }
            mysqli_query($connect,$sql);
        }
        if(isset($_POST['file3'])){
            $f3 = null;
            $file3 = $_GET['file3'];
            unlink($path.$file3);
            $sql;
            if($page=="board"){
                $sql = "update board set filename_2 = null where num = $num";
            }else{
                $sql = "update download set filename_2 = null where num = $num";
                mysqli_query($connect,$sql);  
                $sql = "update download set file_type2 = null where num = $num";
            }
            mysqli_query($connect,$sql);
        }
        if($_POST['content']=="" || $_POST['title']==""){
            echo "<script>alert('모두 써야 됩니다');</script>";
        }
        $subject = $_POST['title'];
        $content = $_POST['content'];
        if($page == 'board'){
            $sql = "update board set subject = '$subject', content = '$content' where num = $num";
        }elseif($page=="data"){
            $sql = "update download set subject = '$subject', content = '$content' where num = $num";
        }
        mysqli_query($connect,$sql);
        // echo "<script>location.href='board_list.php?pageno=$pageno&page=$page';</script>";
    
        
?>