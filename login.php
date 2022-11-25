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
    .subp{
        text-align:center;
    }
    .sub{
        width:100px;
        height:30px;

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
            if(isset($_SESSION['id'])){
                echo "
                <div class='right'>
                    <p><a href='login.php'>로그아웃</a> </p>
                </div>
                ";
            }else{
                echo"
                <div class='right'>
                    <p><a href='logout.php'>로그인</a> <a href='join_form.php'>회원가입</a></p>
                </div>";
            }
            ?>
        </div>

        <div class="nav">
            <p class = 'navp'><a href="main.php">home</a> <a href="visit.php">방명록</a> <a href="board.php">게시판</a> <a href="things.php">자료실</a></p>
        </div>
        <div class="main">
            <h1>로그인 페이지</h1>
            <hr class="main">
            <p>로그인 폼</p>
            <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">          
            <p>아이디 : <input type="text" id = 'id' name = 'id'></p>
            <p>비밀번호 : <input type="password" id = 'password' name = 'password'></p>
            <p class ='subp'><input type="submit" class="sub" value = "가입"> <input type="reset" value="취소" class="sub"></p>

            </form>
        </div>
        <div class="footer">
        
        </div>

    </div>
</body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['id']==null || $_POST['password'] == null){
            echo "<script>alert('모두 입력하세요');</script>";
            echo "<script> history.back();</script>";
        }else{
            $id = $_POST['id'];
            $pw = $_POST['password'];
            include 'dbconnect.php';
            $sql = "select * from member where id = '$id'";
            $result = mysqli_query($connect,$sql);
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_array($result)){
                    if($row['pw']==$pw){
                        $_SESSION['user_id'] = $id;
                        $_SESSION['user_name'] = $row['name'];
                        echo "<script>alert('로그인 성공');</script>";
                        echo "<script> location.href = 'main.php';</script>";
                    }else{
                        echo "<script>alert('로그인 실패');</script>";
                        echo "<script> history.back();</script>";
                    }
                }
            }else{
                echo "<script>alert('로그인 실패');</script>";
                echo "<script> history.back();</script>";
            }
        }
    }
?>