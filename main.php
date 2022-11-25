<?php session_start() ?>
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
    .main{
        margin-top:100px;
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
            <h1 class = 'main'>메인페이지 입니다.</h1>
        </div>
        <div class="footer">
        
        </div>

    </div>
</body>
</html>