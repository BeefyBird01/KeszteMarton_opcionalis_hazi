<?php  include 'header.php';?>

<?php
if(isset($_POST['delete_user'])){
  $sql="DELETE FROM guitar WHERE user_id = '{$_POST['delete_user']}'";
  mysqli_query($link,$sql);
  $sql="DELETE FROM user WHERE id='{$_POST['delete_user']}'";
  mysqli_query($link,$sql);
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
    <div style="margin-top:40mm">
  <div style="width: 100% ;text-align: center ;margin-bottom: 15mm">
      Name of the new guitar type
  </div>
  <form action="index.php" method="POST">
    <div style="text-align: center">
    <input type="text" name="new_type">
    <button type="submit" class="button2">Create</button>
    </div>
    </form>
</div>
<?php  include 'footer.php';?>