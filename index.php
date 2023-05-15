<?php  include 'header.php';?>

<?php
unset($_SESSION['mod_guitar']);
if(isset($_POST['delete_user'])){
  $sql="DELETE FROM guitar WHERE user_id = '{$_POST['delete_user']}'";
  mysqli_query($link,$sql);
  $sql="DELETE FROM user WHERE id='{$_POST['delete_user']}'";
  mysqli_query($link,$sql);
  if($_SESSION['user_id']==$_POST['delete_user']){
    unset($_SESSION['username']);
    unset($_SESSION['admin']);
    $_SESSION['logged_in']=0;
    header("Location: login.php");
  }
}
if(isset($_POST['new_type'])){
  $sql="insert into types (name) values ('{$_POST['new_type']}')";
  mysqli_query($link,$sql) or die(mysqli_error($link));
}
if(isset($_POST['skin_change'])){
  $sql="UPDATE user SET skin='{$_POST['skin_change']}' WHERE username='{$_SESSION['username']}'";
  mysqli_query($link,$sql) or die(mysqli_error($link));
  $_SESSION['skin'] = $_POST['skin_change'];
}
?>
<html>
  <head>
    <title>Guitar Database</title>
    <?php
    if($_SESSION['skin']==0) echo '<link rel="stylesheet" type="text/css" href="style/style-bright.css" />';
    else if($_SESSION['skin']==1) echo '<link rel="stylesheet" type="text/css" href="style/style-dark.css" />';
    else if($_SESSION['skin']==2) echo '<link rel="stylesheet" type="text/css" href="style/style-hendrix.css" />';
    else if($_SESSION['skin']==3) echo '<link rel="stylesheet" type="text/css" href="style/style-metal.css" />';
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
  </head>
  <body>
  <?php include 'menu.php'; ?>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Genre</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($_SESSION['admin']==1){
            $sql = "SELECT username, genre, id FROM user";
        }
        else{
          $sql = "SELECT username, genre, id FROM user WHERE username = '{$_SESSION['username']}'";
        }
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
        ?>
        <?php while($row = mysqli_fetch_array($result)): ?>
        <tr>
          <td><?=$row['username']?></td>
          <td><?=$row['genre']?></td>
          <td>
            <form action="guitar.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
            <button class="button2" type="submit">Guitars</button>
          </form>
          <form action="embermod.php" method="post">
            <input type="hidden" name="username" value="<?php echo $row['username']?>">
            <input type="hidden" name="genre" value="<?php echo $row['genre'];?>">
            <input type="hidden" name="user_id" value="<?php echo $row['id'];?>">
            <button class="button2" type="submit">Modify</button>
          </form>
          <form action="index.php" method="POST">
            <input type="hidden" name="delete_user" value="<?php echo $row['id'];?>">
            <button class="button2" type="submit">Delete</button>
          </form>
          </td>
        </tr>
        <?php endwhile; ?> 
      </tbody>
    </table>
    <?php  include 'footer.php';?>