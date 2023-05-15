<?php  include 'conn/conn.php';
$link=getDb();
session_start();

if(isset($_POST['signup_username']) && isset($_POST['signup_password'])){
    $username=mysqli_real_escape_string($link,$_POST['signup_username']);
    $sql = "SELECT username FROM user WHERE username = '$username'";

    $result=mysqli_query($link,$sql);

    if(mysqli_num_rows($result)==0){
        $passwrd=hash('SHA256',mysqli_real_escape_string($link,$_POST['signup_password']));
        $sql="insert into user (username, passwrd, admn) values ('$username', '$passwrd', 0);";
        mysqli_query($link,$sql) or die(mysqli_error($link));
        echo "<script> alert('Succesful registration');
        window.location.href = 'login.php';
        </script>";
    }
    else if(mysqli_num_rows($result)==1){
        echo "<script> alert('Somebody already exists with this username');
    window.location.href = 'signup.php';
    </script>";
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
      
    
        <p style="text-align: center; text-decoration: underline; font-size: 20mm; margin-bottom: 5mm;">Signup</p>
        <table class="table-mod" style="margin-top: 0mm; width: 30%;">
        <form action="signup.php" method="post">
            <tr class="tr-mod">
                <td class="td-mod">Username: </td>
                <td class="td-mod"><input type="text" name="signup_username" required></td>
            </tr>
            <tr class="tr-mod">
                <td class="td-mod">Password:</td>
                <td class="td-mod"><input type="password" name="signup_password" required></td>
            </tr>
            <tr class="tr-mod">
                <td class="td-mod">
                    <button type=submit class=button2>Sign Up</button>                  
                </td>            
        </form>
        <form action="login.php">
                <td class="td-mod">
                    <a href="login.php"><button class=button2 type="submit">Back</button></a>                  
                </td>
                </form>
        </tr>
</table>
    
<?php  include 'footer.php';?>