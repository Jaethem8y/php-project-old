<?php
    $num = $_GET['num'];
    $pageno = $_GET['pageno'];
    session_start();
    include 'dbconnect.php';
    $sql = "select * from download where num = $num";
    $page = $_GET['page'];
    $result = mysqli_query($connect,$sql);
    while($row = mysqli_fetch_array($result)){
        $subject = $row['subject'];
        $name = $row['name'];
        $id = $row['id'];
        if($row['filename_0'] != null){
            $file1 = $row['filename_0'];
        }else{
            $file1 = null;
        }
        if($row['filename_1'] != null){
            $file2 = $row['filename_1'];

        }else{
            $file2 = null;
        }
        if($row['filename_2'] != null){
            $file3 = $row['filename_2'];
        }else{
            $file3 = null;
        }
      
        $hit = $row['hit'];
        $content = $row['content'];
        

    }
    $hit +=1;
    $sql = "update download set hit = $hit where num = $num";
    mysqli_query($connect,$sql);
?>

<!DOCTYPE html>
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
    .main h1{
       margin: 20px 0 0 0;
    }
    .main hr{
        margin:0 0 20px 0;
    }
    .board{
        background:lightgrey;
        height:40px;
    }
    .leftc{
        float:left;
        margin-left:40px;
    }
    .rightc{
        float:right;
        margin-right:40px;
    }
    img{
        margin:0 auto;
        margin-top:60px;
    }
    .imgp{
        text-align:center;
    }
    .contentp{
        padding:80px 0 20px;
    }
    .btn{
        text-align:right;
    }
    .subsubsub{
        width:150px;
        height:30px;
        background:darkgrey;
        color:white;
        font-weight:bold;
        padding:10px 30px;
        margin-bottom:50px;
        border-radius:10px;
    }
    .subsubsubsub{
        width:150px;
        height:30px;
        background:black;
        color:white;
        font-weight:bold;
        padding:10px 30px;
        margin-bottom:50px;
        border-radius:10px;

    }
    .mar{
        
        height:10px;
        padding-top:35px;
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
                    <p><a href='logout.php'>로그아웃</a> </p>
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
            <h1>자료실</h1>
            <hr>
            <div class="board">
                <?php
                    echo "<p class='leftc'>\t$subject</p><p class = 'rightc'>$name|조회:$hit|\t</p>";
                    echo "<div class = 'mar'></div>";
                    if($file1 != null ){
                        $size1=filesize("pics/$file1");
                        echo "<p> \t 첨부파일 : $file1 $size1 bytes <a href = 'download.php?file=$file1'>[저장]</a></p>";
                    }else{
                        $f1 = null;
                    }
                    if($file2 != null){
                        $size2=filesize("pics/$file2");

                        echo "<p> \t 첨부파일 : $file2 $size2 bytes <a href = 'download.php?file=$file2'>[저장]</a></p>";                  }else{
                        $f2 = null;
                    }
                    if($file3 != null){
                        $size3=filesize("pics/$file3");

                        echo "<p> \t 첨부파일 : $file3 $size3 bytes <a href = 'download.php?file=$file3'>[저장]</a></p>";                    }else{
                        $f3= null;
                    }
                    echo "<p class = 'contentp'>$content</p>";
                ?>
                    <hr>
                    <p class='btn'>
                        <a href="board_list.php<?php echo"?page=".$page ?>" class = 'subsubsub'>목록</a>
                        <?php
                            if($_SESSION['user_id']==$id){
                                echo "
                                <a href='board_write_form.php?subject=$subject&content=$content&file1=$file1&file2=$file2&file3=$file3&num=$num&pageno=$pageno&page=data' class = 'subsubsub'>수정</a>
                                <a href='board_delete.php?num=$num&page=$page&pageno=$pageno&file1=$file1&file2=$file2&file3=$file3' class = 'subsubsub'>삭제</a>
                                <a href='board_write_form.php' class = 'subsubsubsub'>글쓰기</a>
                                ";
                            }
                        ?>
                    </p>
            </div>
        </div>
        <div class="footer">
       
        </div>

    </div>
</body>
</html>