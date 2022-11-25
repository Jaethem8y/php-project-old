<?php
session_start();
session_destroy();
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}?>
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
        margin:  0 5px;
    }
    .check{
        font-size:12px;
        text-decoration:none;
        background: darkgrey;
        color:white;
        border:0.1px solid black;
        padding:1px;
        border-radius:2px;
        font-weight:bold;
    }
    .imp{
        color:red;
    }
    
    </style>
</head>
<body>
    <div class="all">
        <div class="header">
            <div class="left">
                <p><img src="seojin.JPG" alt="none"></p>
            </div>
            <div class="right">
                <p><a href="login.php">로그인</a> <a href="join_form.php">회원가입</a>  </p>
            </div>
        </div>
        <div class="nav">
            <p class = 'navp'><a href="main.php">home</a> <a href="guest.php">방명록</a> <a href="board_list.php?page=board">게시판</a> <a href="board_list.php?page=data">자료실</a></p>
        </div>

        <?php

           



            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                if(test_input($_POST["name"])==null){?>
                    <div class="main">
                        <h1>회원가입</h1>
                        <hr class="main">
                        <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                        <p>회원가입 폼</p>
                        <p>이름 : <input type="text" id = 'name' name = 'name'><span class="imp"> * 이름이 비었습니다 </span></p>
                        
                    
                <?php
                }else{?>
                    <div class="main">
                        <h1>회원가입</h1>
                        <hr class="main">
                        <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                        <p>회원가입 폼</p>
                        <p>이름 : <input type="text" id = 'name' name = 'name'><span class="imp"> *</span></p>
                <?php  
                }
                if(test_input($_POST["pw"]) == null){?>
                        <p>아이디 : <input type="text" id = 'id' name = 'id'> <span class="imp"> *아이디가 비었습니다 </span></p>
                    <?php
                }else{?>
                    <p>아이디 : <input type="text" id = 'id' name = 'id'> <span class="imp"> * </span></p>

                <?php
                }  
                if(test_input($_POST["pw"]) == null){?>
                        <p>비밀번호 : <input type="password" id = 'pw' name = 'pw'><span class="imp"> *비밀번호가 비었습니다 </span></p>
                        <p>전화번호 : <input type="text" id = 'tel' name = 'tel'></p>
                        <p>이메일 : <input type="email" id = 'email' name = 'email'></p>
                        <p class='subp'><input type="submit" value = '가입' class = 'sub'><input type="reset" value = '취소' class = 'sub'></p>
                        </form>
                    </div>
                <?php
                }else{?>
                        <p>비밀번호 : <input type="password" id = 'pw' name = 'pw'><span class="imp"> *</span></p>
                        <p>전화번호 : <input type="text" id = 'tel' name = 'tel'></p>
                        <p>이메일 : <input type="email" id = 'email' name = 'email'></p>
                        <p class='subp'><input type="submit" value = '가입' class = 'sub'><input type="reset" value = '취소' class = 'sub'></p>
                        </form>
                    </div>
                 <?php }

                if(test_input($_POST["pw"])!=null &&test_input($_POST["name"])!=null&&test_input($_POST["id"])!=null){
                        include 'dbconnect.php';

                        $name = test_input($_POST["name"]);
                        $id = test_input($_POST["id"]);
                        $pw = test_input($_POST["pw"]);
                        $tel = "";
                        $email="";
                        date_default_timezone_set('Asia/Seoul');
                        $date = date('Y/m/d h:i:s a',time());
                        $ip = $_SERVER['REMOTE_ADDR'];

                        if(test_input($_POST['tel'])!= null){
                            $tel = test_input($_POST['tel']);
                        }
                        if(test_input($_POST['email'])!=null){
                            $email = test_input($_POST['email']);
                        }
                        $sql = "create table if not exists member (no int not null primary key auto_increment, name varchar(20), id varchar(20), pw varchar(20),tel varchar(20) ,email varchar(20), regdate datetime, ip varchar(30))";
                        if(mysqli_query ($connect,$sql)){
                            
                            $sql = "select * from member where id = '$id'";
                            $result = mysqli_query($connect,$sql);
                            if(mysqli_num_rows($result) == 0){

                                $sql = "insert into member(name, id , pw, tel, email, regdate,ip) values('$name','$id','$pw','$tel','$email','$date','$ip')";
                                
                                if(mysqli_query($connect,$sql)){
                                    echo "<script> alert('회원가입 완료');</script>";
                                    echo "<script>location.href = 'main.php'</script>";

                                }else{
                                    echo "<script> alert('회원가입 실패');</script>";
                                    echo "<script>history.back();</script>";
                                }
                            }else{
                                echo "<script> alert('회원가입 실패');</script>";
                                echo "<script>history.back();</script>";
                            }
                            
                        }else{
                            echo "<script> alert('회원가입 실패');</script>";
                            echo "<script>history.back();</script>";
                        }

                }

            }else{?>
                <div class="main">
                    <h1>회원가입</h1>
                    <hr class="main">
                    <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "post">
                    <p>회원가입 폼</p>
                    <p>이름 : <input type="text" id = 'name' name = 'name'><span class="imp"> * </span></p>
                    <p>아이디 : <input type="text" id = 'id' name = 'id'>  <span class="imp"> * </span></p>
                    <p>비밀번호 : <input type="password" id = 'pw' name = 'pw'><span class="imp"> * </span></p>
                    <p>전화번호 : <input type="text" id = 'tel' name = 'tel'></p>
                    <p>이메일 : <input type="email" id = 'email' name = 'email'></p>
                    <p class='subp'><input type="submit" value = '가입' class = 'sub'><input type="reset" value = '취소' class = 'sub'></p>
                    </form>
                </div>    
            <?php
            } 

        ?>

        
        <div class="footer">
        
        </div>

    </div>
</body>
</html>