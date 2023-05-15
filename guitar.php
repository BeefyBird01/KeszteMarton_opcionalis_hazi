<?php  include 'header.php';?>

<?php
if(isset($_POST['type']) && isset($_POST['strings']) && isset($_POST['girth']) && isset($_POST['tuning']) && isset($_SESSION['mod_guitar'])==false){
  $strings=mysqli_real_escape_string($link,$_POST['strings']);
  $girth=mysqli_real_escape_string($link,$_POST['girth']);
  $tuning=mysqli_real_escape_string($link,$_POST['tuning']);
  $sql = "insert into guitar(types_id,strings,girth,tuning,user_id) values('{$_POST['type']}','$strings','$girth','$tuning','{$_POST['user_id']}')";
  mysqli_query($link,$sql);
}
if(isset($_POST['guitar_delete'])){
  $sql="DELETE FROM guitar WHERE guitar.id = '{$_POST['guitar_delete']}'";
  mysqli_query($link,$sql) or die(mysqli_error($link));
}
if(isset($_SESSION['mod_guitar']) && empty($_POST['mod_canceled'])){
  $sql = "UPDATE guitar SET types_id='{$_POST['type']}',girth='{$_POST['girth']}',strings='{$_POST['strings']}',tuning='{$_POST['tuning']}' WHERE id='{$_POST['guitar_id']}'";
  mysqli_query($link,$sql) or die(mysqli_error($link));
  unset($_SESSION['mod_guitar']);
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
    <table style="width: 80%">
      <thead>
        <tr>
          <th>Type</th>
          <th>Strings</th>
          <th>String Girth</th>
		  <th>Tuning</th>
		  <th>Actions</th>
        </tr>
      </thead>
      <?php
      $sql="SELECT * FROM guitar INNER JOIN types ON types_id = types.id WHERE guitar.user_id = '{$_POST['user_id']}'";
      $result = mysqli_query($link, $sql) or die(mysqli_error($link));
      $sql = "SELECT * FROM guitar WHERE user_id='{$_POST['user_id']}'";
      $result2 = mysqli_query($link, $sql) or die(mysqli_error($link));
      ?>
      <tbody>
      <?php while($row = mysqli_fetch_array($result)): ?>
        <?php $row2=mysqli_fetch_array($result2)?>
        <tr>
          <td><?=$row['name']?></td>
          <td><?=$row['strings']?></td>
		      <td><?=$row['girth']?></td>
		      <td><?=$row['tuning']?></td>
          <td>
            <form action="gitarmod.php" method="POST">
              <input type="hidden" name="guitar_id" value="<?php echo $row2['id']?>">
              <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
            <button class="button2" type="submit">Modify</button>
            </form>
            <form action="guitar.php" method="POST">
            <input type="hidden" name="guitar_delete" value= "<?php echo $row2['id'];?>">
            <input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
            <button class="button2" type="submit">Delete</button>
            </form>
            <form action="gift.php" method="post">
            <button class="button2" type="submit">Gift</button>
            <input type="hidden" name="gift_id" value="<?php echo $row2['id']?>">
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    
    <form action="gitarmod.php" method="post" style="text-align: right; width:90% ">
    <p style= "text-align: right; width:90% " >
      <input style="text-align: right" type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
    <button class="button2" type="submit">New</button>
      </form>
  </p>
  <?php  include 'footer.php';?>