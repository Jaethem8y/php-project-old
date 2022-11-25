<?php
    session_start();
    echo $_POST['title'];
    if(!isset($_POST['title'])||!isset($_POST['content'])||$_POST['title']==null||$_POST['content']==null){
        echo "<script>alert('내용을 적어주세요');</script>";
        echo "<script>history.back();</script>";
    }else{
        $filenames = array();
        $counter = 0;
        for($i=1;$i<=3;$i++){
            $type[$i] =  $_FILES['upfile'.$i]["type"];
            if(isset($_FILES['upfile'.$i])){
                if($_FILES['upfile'.$i]["size"] >5000000){
                    echo "<script>alert('파일이 5MB 초과');history.back();</script>";
                    
                }else{
                    $filename = $_FILES['upfile'.$i]['name'];
                    $tmp_file =  $_FILES['upfile'.$i]['tmp_name'];
                    $file_path = "pics/".$filename;
                    $filenames[$i] = $filename;
                    echo $filenames[$i];
                    if(!move_uploaded_file($tmp_file,$file_path)){
                        // echo "<script>alert('파일 업로드 실패');history.back();</script>";
                    }
                }
            }else{
                $filenames[$i] = null;
            }
        }           
                    $type1 = $type[0];
                    $type2 = $type[1];
                    $type3 = $type[2];
                    $id = $_SESSION['user_id'];
                    $name = $_SESSION['user_name'];
                    $subject = $_POST['title'];
                    $content = $_POST['content'];
                    date_default_timezone_set('Asia/Seoul');
                    $date = date('Y/m/d h:i:s a',time());
                    include 'dbconnect.php';
                    $f0 = $filenames[1];
                    $f1 = $filenames[2];
                    $f2 = $filenames[3];
                    $sql = "insert into download(id,name,subject,content,regdate,filename_0,filename_1,filename_2,file_type0,file_type1,file_type2)values('$id','$name','$subject','$content','$date','$f0','$f1','$f2','$type1','$type2','$type3')";
                    mysqli_query($connect,$sql);
                    $sql = "set @count=0";
                    mysqli_query($connect,$sql);
                    $sql = "update download set num = @count:=@count+1";
                    mysqli_query($connect,$sql);
                    echo"<script>location.href='board_list.php?page=data';</script>";
        }
    ?>
