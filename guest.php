<?php session_start();
    include 'dbconnect.php';
    $sql = "create table if not exists memo(no int primary key auto_increment, id varchar(20), name varchar(20), content varchar(100), regdate datetime)";
    mysqli_query($connect,$sql);
    echo mysqli_error($connect);
    $sql = "create table if not exists memo_reply (no int primary key auto_increment, parent int, id varchar(20), name varchar(20), content varchar(100),regdate datetime)";
    mysqli_query($connect,$sql)

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
    .sub{
        width:150px;
        height:150px;
        position:relative;
        bottom:70px;
        left:10px;
    }
    .dot{
        border-top: 0.1px dotted;
    }
    .comment{
        text-decoration:underline;
    }
    .cent{
        display:flex;
    }
    .leftc{
        width:50px;
    }
    .rightc{
        background:lightgrey;
        width:850px;
        padding:10px;
    }
    .resub{
        width:80px;
        height:25px;
    }
    .reme{
        margin:10px;
    }
    .page{
        margin:0 auto;
    }
    ul{
        display:flex;
        justify-content: space-evenly;

    }
    li{
        display:inline-block;
    }
    .pagesp{
        text-align:center;
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
        <form action= "guest_insert.php" method = "post">
            <p>작성자: <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></p>
            <textarea name="ta" id="ta" cols="100" rows="10"></textarea>
            <input type="submit" value = "메모하기" class = 'sub'>
        </form>
        <?php
            if(!isset($_GET['pageno'])){
                $pageno = 1;
            }else{
                $pageno = $_GET['pageno'];
            }
            $per_page = 3;
            $end = $pageno*3;
            $start = $end-3;
          
            $offset = ($pageno-1)*3;
            $sql = "select count(*) from memo";
            $result = mysqli_query($connect,$sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows/$per_page);
            if($total_pages==0){
                $total_pages=1;
            }
            $sql = "select * from memo limit 3 offset $offset";
            $result = mysqli_query($connect,$sql);
           

           while($row = mysqli_fetch_array($result)){
               $no = $row['no'];
                echo "<hr><p>".$row['no']."\t".$row['name']."\t".$row['regdate']."</p><hr class = 'dot'><p>".$row['content'];
                if(!isset($_SESSION['user_name'])){
                    
                }else{
                    if ($_SESSION['user_name'] == $row['name']){
                        echo "\t<a href = 'guest_delete.php?no=$no'>삭제</a>";
                    }
                }
                echo "</p>
                    <div class='cent'>
                        <div class='leftc'>
                            <p class = 'comment'>덧글</p>
                        </div>
                        <div class='rightc'>";
                         $sqlc = "select * from memo_reply where parent ='$no'";
                         $resultc = mysqli_query($connect,$sqlc);
                         while($rowc = mysqli_fetch_array($resultc)){
                             echo "<p>".$rowc['name']."\t".$rowc['regdate'];
                             if(isset($_SESSION['user_name'])){
                                if ($_SESSION['user_name'] == $rowc['name']){
                                    $nock = $rowc['no'];
                                    echo "\t<a href = 'guest_reply_delete.php?no=$nock'>삭제</a>";
                                }
                            }
                             echo "\t"."</p><p>".$rowc['content']."</p><hr class = 'dot'>";
                         }
                         echo"
                         <form action='guest_reply_insert.php?no=$no' method ='post'>
                            <p class = 'reme'><textarea name='re' id='re' cols='80' rows='1'></textarea>
                            <input type='submit' class = 'resub'></p>
                         </form>";
                        
                echo"
                        </div>
                    </div>"; 
           }
        ?>

        </div>
        <div class="footer">
            <div class="pages">
                <ul>
                    <p class = 'pagesp'>
                        <li><a href="guest.php?pageno=1">[First]</a></li>
                        <li><a href="guest.php?pageno=<?php
                            if($pageno-1==0){
                                echo $pageno;
                            }else{
                                echo $pageno-1;
                            }
                        ?>">[Prev]</a></li>

                        <?php
                            $tot = $pageno+4;
                            for($i=$pageno-5;$i<=$tot;$i++){
                                if($i<1){
                                    $tot++;
                                }elseif($i>$total_pages){

                                }else{
                                echo " <li><a href='guest.php?pageno=$i'>$i</a></li>";
                                }
                            }

                        ?>
                        <li><a href="guest.php?pageno=<?php
                        if($pageno+1 >$total_pages){
                            echo $pageno;
                        }else{
                            echo $pageno+1;
                        }
                        ?>">[next]</a></li>

                        <li><a href="guest.php?pageno=<?php echo $total_pages;?>">[Last]</a></li>
                    </p>
                </ul>
            </div>
        </div>

    </div>
</body>
</html>