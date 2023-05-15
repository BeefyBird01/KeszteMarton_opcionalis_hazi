<?php include 'header.php';?>

<?php
if(isset($_POST['gifted_user'])) {
    $sql = "UPDATE guitar SET user_id='{$_POST['gifted_user']}' WHERE id = '{$_POST['gift_id']}'";
    mysqli_query($link,$sql) or die(mysqli_error($link));
    header("Location: index.php");
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
    <?php
    if($_SESSION['admin']==0)
	    $sql="SELECT * FROM user WHERE id <> '{$_SESSION['user_id']}'";
    else $sql="SELECT * FROM user";
	    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>

  <form action="gift.php" method="post">
      <div style="margin: auto; padding: 5mm">
      <div>Gift guitar</div>
    <select name = "gifted_user">
	<?php while($row = mysqli_fetch_array($result)): ?>
		<option value = "<?=$row['id']?>"><?=$row['username']?></option>
	<?php endwhile; ?>
	</select>
    <button type="submit" class="button2">Submit</button>
    <input type="hidden" name="gift_id" value="<?php echo $_POST['gift_id'];?>">
    </div>
    
    </form>
    <?php
    if(isset($_POST['searched_user'])){
        $sql="SELECT * FROM guitar INNER JOIN types ON types_id = types.id WHERE guitar.user_id = '{$_POST['searched_user']}'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    }
    
    ?>
  <?php include 'footer.php';?>