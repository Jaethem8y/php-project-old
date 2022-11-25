<?php
    $num = $_GET['num'];
    $pageno = $_GET['pageno'];
    session_start();
    include 'dbconnect.php';
    $sql = "select * from board where num = $num";
    $page = $_GET['page'];
    $result = mysqli_query($connect,$sql);
    while($row = mysqli_fetch_array($result)){
        $subject = $row['subject'];
        $name = $row['name'];
        $id = $row['id'];
        if($row['filename_0'] != null){
            $file1 = "pics\\".$row['filename_0'];
            $f1 = $row['filename_0'];
        }else{
            $file1 = null;
        }
        if($row['filename_1'] != null){
            $file2 = "pics\\".$row['filename_1'];
            $f2 = $row['filename_1'];

        }else{
            $file2 = null;
        }
        if($row['filename_2'] != null){
            $file3 = "pics\\".$row['filename_2'];
            $f3 = $row['filename_2'];

        }else{
            $file3 = null;
        }
      
        $hit = $row['hit'];
        $content = $row['content'];
        

    }
    $hit +=1;
    $sql = "update board set hit = $hit where num = $num";
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
            <h1>게시판</h1>
            <hr>
            <div class="board">
                <?php
                    echo "<p class='leftc'>\t$subject</p><p class = 'rightc'>$name|조회:$hit|\t</p>";
                    
                    if($file1 != null ){
                        $width = getimagesize($file1)[0];
                        $height = getimagesize($file1)[1];
                        echo "<p class='imgp' ><img src= $file1 alt='none' width ='$width' height='$height'></p>";
                    }else{
                        $f1 = null;
                    }

                    if($file2 != null){
                       
                        $width = getimagesize($file2)[0];
                        $height = getimagesize($file2)[1];
                        echo "<p class='imgp' ><img src=$file2 alt='none' width ='$width' height ='$height'></p>";
                    }else{
                        $f2 = null;
                    }
                    if($file3 != null){
                        $width = getimagesize($file3)[0];
                        $height = getimagesize($file3)[1];
                        echo "<p class='imgp' ><img src=$file3 alt='none' width = '$width' height = '$height'></p>";
                    }else{
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
                                <a href='board_write_form.php?subject=$subject&content=$content&file1=$f1&file2=$f2&file3=$f3&num=$num&pageno=$pageno&page=$page' class = 'subsubsub'>수정</a>
                                <a href='board_delete.php?num=$num&page=$page&pageno=$pageno&file1=$f1&file2=$f2&file3=$f3' class = 'subsubsub'>삭제</a>
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