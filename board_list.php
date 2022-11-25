<?php 
    session_start();
    include 'dbconnect.php';
    $sql = "create table if not exists board(num int primary key auto_increment,id varchar(20),name varchar(20),subject varchar(20) not null, content varchar(100) not null, regdate datetime, hit int default 0, is_html tinyint,filename_0 varchar(20), filename_1 varchar(20), filename_2 varchar(20),filename_3 varchar(20)) ";
    mysqli_query($connect,$sql);
    $sql = "create table if not exists download(num int primary key auto_increment,id varchar(20),name varchar(20),subject varchar(20) not null, content varchar(100) not null, regdate datetime, hit int default 0, is_html tinyint,filename_0 varchar(20), filename_1 varchar(20), filename_2 varchar(20),file_type0 varchar(20),file_type1 varchar(20),file_type2 varchar(20))";
    if(!mysqli_query($connect,$sql)){
        echo mysqli_error($connect);
    }
    $page = $_GET['page'];
    if($page == "board"){
        $sql = "set @count=0";
        mysqli_query($connect,$sql);
        $sql = "update board set num = @count:=@count+1";
        mysqli_query($connect,$sql);
    }elseif($page == "data"){
        $sql = "set @count=0";
        mysqli_query($connect,$sql);
        $sql = "update downloads set num = @count:=@count+1";
    }
    if(!isset($_SESSION['user_name'])){
        echo "<script>alert('로그인후 이용할수 있습니다');location.href='main.php';</script>";
    }
    
    


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
    .footer ul{
        display:flex;
        justify-content: space-evenly;

    }
    li{
        display:inline-block;
    }
    .pagesp{
        text-align:center;
    }
    .ululul{
        list-style-type:disc;
        margin:0;
        float:left;
    }
    .leftpp{
        margin:0;
        float:left;
    }
    .rightddd{
        float:right;
        margin:0;
        padding:0;
    }
    hr{
        margin-top:60px;
    }
    .firs{
        text-align:center;
    }
    .uno{
        width:10%;
    }
    .dos{
        width:51%;
    }
    .tres{
        width:10%;
    }
    .quatro{
        width:25%;
    }
    .cinco{
        width:15%;
    }
    .write{
        padding:10px 40px;
        color:white;
        background:black;
        font-weight: bold;
        border-radius:5px;
        text-decoration:none;
        text-align:right;
    }
    .writep{
        text-align:right;
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
            }elseif($page=="data"){
                echo "<h1>자료실</h1>";
            }
        ?>
        
        <hr>
        <?php
        if($page == "board"){
            $sql;
            if(isset($_POST['sel'])&&isset($_POST['value'])){
                $type = $_POST['sel'];
                $object = $_POST['value'];
                $sql = "select count(*)from board where $type like '%$object%'";
            }else{
                $sql = "select count(*)from board";
            }
            $result = mysqli_query($connect,$sql);
            $count = mysqli_fetch_array($result)[0];
            echo "<ul class = 'ululul'><li><p class = leftpp>총 $count 개의 게시물이 있습니다.</p></li></ul>";
            echo "
            <div class='rightddd'><form action='board_list.php?page=board' method = 'POST'>
                <select name='sel' id='sel'>
                    <option value='subject'>제목</option>
                    <option value='writer'>글쓴이</option>
                    <option value='num'>번호</option>
                </select>
                <input type='text' name = 'value'>
                <input type='submit' value = '검색'>                
            </form></div>";
            
        }elseif($page=="data"){
            $sql;
            if(isset($_POST['sel'])&&isset($_POST['value'])){
                $type = $_POST['sel'];
                $object = $_POST['value'];
                $sql = "select count(*)from download where $type like '%$object%'";
            }else{
                $sql = "select count(*)from download";
            }
            $result = mysqli_query($connect,$sql);
            $count = mysqli_fetch_array($result)[0];
            echo "<ul class = 'ululul'><li><p class = leftpp>총 $count 개의 게시물이 있습니다.</p></li></ul>";
            echo "
            <div class='rightddd'><form action='board_list.php?page=data' method = 'POST'>
                <select name='sel' id='sel'>
                    <option value='subject'>제목</option>
                    <option value='id'>글쓴이</option>
                    <option value='num'>번호</option>
                </select>
                <input type='text' name = 'value'>
                <input type='submit' value = '검색'>                
            </form></div>";
            
        }
            
        ?>

        <hr>
        <table>
        <tr>
                <td class = 'uno firs'>번호</td>
                <td class = 'dos firs'>제목</td>
                <td class='tres firs'>글쓴이</td>
                <td class = 'quatro firs'>등록일</td>
                <td class = 'cinco firs'>조회</td>

            </tr>
        
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
            if($page == "board"){
                $sql;
                if(isset($_POST['sel'])&&isset($_POST['value'])){
                    $sql = "select count(*) from board where $type like '%$object%'";
                    
                }else{
                    $sql = "select count(*) from board";
                }
               
                $result = mysqli_query($connect,$sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows/$per_page);
                if($total_pages==0){
                    $total_pages=1;
                }
                if(isset($_POST['sel'])&&isset($_POST['value'])){
                    $sql = "select * from board where $type like '%$object%' order by num desc limit 3 offset $offset ";
                           
                }else{
                    $sql = "select * from board order by num desc limit 3 offset $offset";
                }
                $result = mysqli_query($connect,$sql);
                if(mysqli_num_rows($result)== 0){

                }else{
                    while($row = mysqli_fetch_array($result)){
                        $no = $row['num'];
                        $subject = $row['subject'];
                        $name = $row['name'];
                        $date = $row['regdate'];
                        $hit = $row['hit'];
                        echo"
                        <tr>
                        <td class = 'uno firs'>$no</td>
                        <td class = 'dos firs'><a href = 'board_view.php?num=$no&pageno=$pageno&page=$page'>$subject</td>
                        <td class='tres firs'>$name</td>
                        <td class = 'quatro firs'>$date</td>
                        <td class = 'cinco firs'>$hit</td>
                            </tr>";
                    }
                }
            }elseif($page == "data"){
                $sql;
                if(isset($_POST['sel'])&&isset($_POST['value'])){
                    $sql = "select count(*) from download where $type like '%$object%'";
                    
                }else{
                    $sql = "select count(*) from download";
                }
               
                $result = mysqli_query($connect,$sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows/$per_page);
                if($total_pages==0){
                    $total_pages=1;
                }
                if(isset($_POST['sel'])&&isset($_POST['value'])){
                    $sql = "select * from download where $type like '%$object%' order by num desc limit 3 offset $offset ";
                           
                }else{
                    $sql = "select * from download order by num desc limit 3 offset $offset";
                }
                $result = mysqli_query($connect,$sql);
                if(mysqli_num_rows($result)  == 0){

                }else{
                    while($row = mysqli_fetch_array($result)){
                        $no = $row['num'];
                        $subject = $row['subject'];
                        $name = $row['name'];
                        $date = $row['regdate'];    
                        $hit = $row['hit'];
                        echo"
                        <tr>
                        <td class = 'uno firs'>$no</td>
                        <td class = 'dos firs'><a href = 'board_data_view.php?num=$no&pageno=$pageno&page=$page'>$subject</td>
                        <td class='tres firs'>$name</td>
                        <td class = 'quatro firs'>$date</td>
                        <td class = 'cinco firs'>$hit</td>
                            </tr>";
                            
                    }
               }
            }
            
        ?>
        </table>
        <p class='writep'><a href="board_write_form.php?<?php echo "page=$page" ?>" class="write">작성하기</a></p>

        </div>
        <div class="footer">
            <div class="pages">
                <ul>
                    <p class = 'pagesp'>
                        <li><a href="?pageno=1&<?php echo"page=$page";?>">[First]</a></li>
                        <li><a href="?pageno=<?php
                            if($pageno==1){
                                echo $pageno;
                            }else{
                                echo $pageno-1;
                            }
                            echo"&page=$page";
                            ?>">[Prev]</a></li>

                        <?php
                            $tot = $pageno+4;
                            for($i=$pageno-5;$i<=$tot;$i++){
                                if($i<1){
                                    $tot++;
                                }elseif($i>$total_pages){

                                }else{
                                echo " <li><a href='?pageno=$i&page=$page'>$i</a></li>";
                                }
                            }

                        ?>
                        <li><a href="?pageno=<?php
                        if($pageno == $total_pages){
                            echo $pageno;
                        }else{
                            echo $pageno+1;
                        }
                        echo"&page=$page";
                        ?>">[next]</a></li>

                        <li><a href="?pageno=<?php echo $total_pages."&page=$page";?>">[Last]</a></li>
                    </p>
                </ul>
            </div>
        </div>

    </div>
</body>
</html>