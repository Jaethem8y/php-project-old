<?php
    session_start();
    include 'dbconnect.php';
    $sql = "create table if not exists board(num int primary key auto_increment,id varchar(20),name varchar(20),subject varchar(20), content varchar(100), regdate datetime, hit int default 0, is_html tinyint,filename_0 varchar(20), filename_1 varchar(20), filename_2 varchar(20),filename_3 varchar(20)) ";
    mysqli_query($connect,$sql);
    $sql = "set @count=0";
    mysqli_query($connect,$sql);
    $sql = "update board set num = @count:=@count+1";
    mysqli_query($connect,$sql);
    if(!isset($_SESSION['user_id'])){
        echo "<script>alert('로그인후 사용가능');history.back();</script>";
    }


    $type1 ="";
    $type2 = "";           
    $type3 = "";
    $page = $_GET['page'];


    if(isset($_GET['num'])){
        $num = $_GET['num'];
        $fname1 = $_GET['file1'];
        $fname2 = $_GET['file2'];
        $fname3 = $_GET['file3'];
        $pageno = $_GET['pageno'];
        
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $page = $_GET['page'];
    
    if(isset($_GET['num'])){
        $num = $_GET['num'];
        $pageno = $_GET['pageno'];
    }
    if($page == "board"){
        $path = 'pics/';
        if(isset($_POST['file1'])){
            $f1 = null;
            $fname1 = $_GET['fname1'];
            unlink($path.$fname1);
            $sql = "update board set filename_0 = null where num = $num";
            mysqli_query($connect,$sql);            
        }
        if(isset($_POST['file2'])){
            $f2 = null;
            $fname2 = $_GET['fname2'];
            unlink($path.$fname2);
            $sql = "update board set filename_1 = null where num = $num";
            mysqli_query($connect,$sql);
        }
        if(isset($_POST['file3'])){
            $f3 = null;
            $fname3 = $_GET['fname3'];
            unlink($path.$fname3);
            $sql = "update board set filename_2 = null where num = $num";
            mysqli_query($connect,$sql);
        }
    }else{
        $path = 'pics/';
        if(isset($_POST['file1'])){
            $f1 = null;
            $fname1 = $_GET['fname1'];
            unlink($path.$fname1);
            $sql = "update download set filename_0 = null where num = $num";
            mysqli_query($connect,$sql); 
            $sql = "update download set file_type0 = null where num = $num";
            mysqli_query($connect,$sql);            
        }
        if(isset($_POST['file2'])){
            $f2 = null;
            $fname2 = $_GET['fname2'];
            unlink($path.$fname2);
            $sql = "update download set filename_1 = null where num = $num";
            mysqli_query($connect,$sql);
            $sql = "update download set file_type1 = null where num = $num";
            mysqli_query($connect,$sql);   
        }
        if(isset($_POST['file3'])){
            $f3 = null;
            $fname3 = $_GET['fname3'];
            unlink($path.$fname3);
            $sql = "update download set filename_2 = null where num = $num";
            mysqli_query($connect,$sql);
            $sql = "update download set file_type2 = null where num = $num";
            mysqli_query($connect,$sql);   
        }
    }
    
        if($_POST['content']=="" || $_POST['title']==""){
            echo "<script>alert('모두 써야 됩니다');</script>";
        }
        $subject = $_POST['title'];
        $content = $_POST['content'];
        if($page == "board"){
            $sql = "update board set subject = '$subject', content = '$content' where num = $num";
        }else{
            $sql = "update download set subject = '$subject', content = '$content' where num = $num";
        }
        
        if(!mysqli_query($connect,$sql)){
            echo mysqli_error($connect);
        }
        echo "<script>location.href='board_list.php?pageno=$pageno&page=$page';</script>";
    }
       
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
        margin:0;
        padding:0;
    }
    .all{
        width:900px;
        margin:0 auto;
    }
    .header{
        display:flex;
        justify-content:space-between;
    }
    .nav{
        background:#3366cc;
    }
    .right{
        margin:10px;
    }
    .navp{
        letter-spacing:1px;
        margin:0;
    }
    .navp a{
        font-size:20px;
        color:white;
        font-weight:bold;
        padding:10px;
    }
    .title{
        width:100%;
        text-align:center;
        background:#f0f0f0;
        height:30px;
    }
    .fir{
        text-align:center;
        width:100px;
        background:#f0f0f0;
        padding:5px;
        
    }
    .titlet{
        width:750px;
    }
    .subb{
        float: right;
    }
    .write{
        width:100px;
        border-radius:5px;
        color:white;
        background:black;
        margin-right:20px;
    }
    .list{
        width:200px;
        padding:2px 25px;
        border-radius:5px;
        color:white;
        background:darkgrey;
        text-decoration:none;
        border:0.1px solid black;
    }
    </style>
</head>
<body>
    <div class="all">
        <div class="header">
            <div class="left">
                <p><a href="main.php"><img src="seojin.JPG" alt="none"></a></p>
            </div>
            <?php
            if(isset($_SESSION['user_id'])){
                echo "
                <div class='right'>
                    <p><a href='logout.php'>로그아웃</a></p>
                </div>
                ";
            }else{
                echo"
                <div class='right'>
                    <p><a href='login.php'>로그인</a> <a href='join_form.php'>회원가입</a></p>
                </div>";
            }
            ?>
        </div>

        <div class="nav">
            <p class = 'navp'><a href="main.php">home</a> <a href="guest.php">방명록</a> <a href="board_list.php?page=board">게시판</a> <a href="board_list.php?page=data">자료실</a></p>
        </div>
        <div class="main">
            <?php  
                if($page == "board"){
                    echo "<h1>게시판</h1>";
                }else{
                    echo "<h1>자료실</h1>";
                }
            ?>
            
            <hr>
            <div class="title">글쓰기</div>
            <?php
                if($page == "board"){
                    if(isset($_GET['num'])){
                        echo "<form method='post' enctype='multipart/form-data' action= 'board_write_form.php?fname1=$fname1&fname2=$fname2&fname3=$fname3&num=$num&pageno=$pageno&page=$page' method = 'post'>";
                    }else{
                        echo "<form method='post' enctype='multipart/form-data' action= 'board_insert.php?page=$page' method = 'post'>";
                    }
                }elseif($page == "data"){
                    if(isset($_GET['num'])){
                        echo "<form method='post' enctype='multipart/form-data' action= 'board_write_form.php?fname1=$fname1&fname2=$fname2&fname3=$fname3&num=$num&pageno=$pageno&page=$page&type1=$type1&type2=$type2&type3=$type3' method = 'post'>";
                    }else{
                        echo "<form method='post' enctype='multipart/form-data' action= 'board_data_write.php?page=$page' method = 'post'>";
                    }
                }
            ?>
            
                <table>
                    <tr>
                        <td class = 'fir'>별명</td>
                        <td class = 'sec'><?php echo $_SESSION['user_name'] ?></td>
                    </tr>
                    <tr>
                        <td class = 'fir'>제목</td>
                        <td class = 'sec'>
                        <input type="text" id = 'title' name = 'title' class = 'titlet' <?php if(isset($_GET['subject'])){echo "value = '".$_GET['subject']."'";}?>></td>
                    </tr>
                    <tr>
                        <td class = 'fir'>내용</td>
                        <td class = 'sec'><textarea name="content" id="content" cols="100" rows="10"><?php
                            if(isset($_GET['content'])){
                                echo $_GET['content'];
                            }
                        ?></textarea></td>
                    </tr>
                    <?php if($page == "board"){ ?>
                        <tr>
                            <td class = 'fir'>이미지 파일1</td>
                            <?php
                                if(isset($_GET['file1']) ){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile1' disabled><br>".$_GET['file1'];
                                        if($_GET['file1'] != ""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file1'  value='file1'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile1'>";
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class = 'fir'>이미지 파일2</td>
                            <?php
                                if(isset($_GET['file2'])){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile2' disabled>
                                    <br>".$_GET['file2'];
                                    if($_GET['file2'] != ""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file2'  value='file2'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile2'>";
                                }
                            ?>
                        </td>
                        </tr>
                        <tr>
                            <td class = 'fir'>이미지 파일3</td>
                            <?php
                                if(isset($_GET['file3'])){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile3' disabled><br>".$_GET['file3'];
                                    if($_GET['file3']!=""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file3' value='file3'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile3' >";
                                }
                            ?>
                        </td>
                        </tr>
                    <?php }else{ ?>
                        <tr>
                            <td class = 'fir'>첨부파일 1</td>
                            <?php
                                if(isset($_GET['file1']) ){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile1' disabled><br>".$_GET['file1'];
                                        if($_GET['file1'] != ""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file1'  value='file1'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile1'>*5Mb 제한";
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class = 'fir'>첨부파일 2</td>
                            <?php
                                if(isset($_GET['file2'])){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile2' disabled> 
                                    <br>".$_GET['file2'];
                                    if($_GET['file2'] != ""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file2'  value='file2'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile2'>*5Mb 제한";
                                }
                            ?>
                        </td>
                        </tr>
                        <tr>
                            <td class = 'fir'>첨부파일 3</td>
                            <?php
                                if(isset($_GET['file3'])){
                                    echo "<td class = 'sec'><input type='file' name = 'upfile3' disabled><br>".$_GET['file3'];
                                    if($_GET['file3']!=""){
                                        echo" 삭제
                                        <input type='checkbox' name = 'file3' value='file3'>
                                        ";
                                    }
                                }else{
                                    echo"<td class = 'sec'><input type='file' name = 'upfile3' >*5Mb 제한";
                                }
                            ?>
                        </td>
                        </tr>
                    <?php }?>
                </table>
                <?php 
                    if(isset($_GET['num'])){
                        echo"
                        <div class='subb'><input type='submit' value = '수정하기' class = 'write'><a href='board_update.php?pageno=$pageno&page=$page&file1=$fname1&file2=$fname2&file3=$fname3' class = 'list'>목록</a></div>
                        ";
                    }else{
                        echo"
                        <div class='subb'><input type='submit' value = '작성하기' class = 'write'><a href='board_list.php' class = 'list'>목록</a></div>
                        ";
                    }
                
                ?>
            </form>
        </div>
        <div class="footer">
        
        </div>

    </div>
</body>
</html>
