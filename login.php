<?php  include 'conn/conn.php';
$link=getDb();
session_start();
$_SESSION['logged_in']=0;
if(isset($_POST['logout'])){
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
    $_SESSION['logged_in']=0;
}

$badlogin = false;
if(isset($_POST['username']) && isset($_POST['passwrd'])){
    $passwrd=hash('SHA256',mysqli_real_escape_string($link,$_POST['passwrd']));
    $username=mysqli_real_escape_string($link,$_POST['username']);
    if (empty($username)) {

        header("Location: login.php?error=User Name is required");

        exit();

    }else if(empty($passwrd)){

        header("Location: login.php?error=Password is required");

        exit();
    }
    else{
        $sql = "SELECT * FROM user WHERE username='$username' AND passwrd = '$passwrd'";
        $result = mysqli_query($link,$sql);
        if(mysqli_num_rows($result)===1){
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['passwrd'] === $passwrd) {
                $_SESSION["username"] = $username;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_genre'] = $row['genre'];
                $_SESSION['skin'] = $row['skin'];
                if($row['admn']==1){
                    $_SESSION['admin'] =1;
                    $_SESSION['logged_in']=1;
                    header("Location: index.php");
                    exit();
                }
                else{
                    $_SESSION['logged_in']=1;
                    $_SESSION['admin'] =0;
                    header("Location: index.php");
                    exit();
                }
            }
            else{
                $badlogin = true;
            }

        }
        else{$badlogin = true;}
    }
}
?>

<html>
  <head>
    <title>Guitar Database</title>
    <link rel="stylesheet" type="text/css" href="style/style-dark.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
  </head>
  <body>
      
    
        <p style="text-align: center; text-decoration: underline; font-size: 20mm; margin-bottom: 5mm;">Guitarist Database</p>
        <p style="text-align: center;">Login</p>
        <table class="table-mod" style="margin-top: 0mm; width: 30%;">
        <form action="login.php" method="post">
            <tr class="tr-mod">
                <td class="td-mod">Username: </td>
                <td class="td-mod"><input type="text" name="username"></td>
            </tr>
            <tr class="tr-mod">
                <td class="td-mod">Password:</td>
                <td class="td-mod"><input type="password" name="passwrd"></td>
            </tr>
            <tr class="tr-mod">
                <td class="td-mod">
                    <a href="signup.php" class="button2">
                    Sign Up
                    </a>
                </td>
                <td class="td-mod">
                    <button type=submit class=button2>Login</button>
                
                    
                </td>

            </tr>
        </from>
    </table>
    <p style= "text-align: center"><?php if($badlogin==true) echo "Bad username or password"; ?> </p>
    
    <?php  include 'footer.php';?>