<?php  include 'header.php';?>

<?php
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
      Skin Change
  </div>
  <div style="text-align: center">
  <form action="index.php" method="post">
					<select name = "skin_change" style="text-align: center;margin-bottom: 15mm">
					          <option value = "0">Bright</option>
                    <option value ="1">Dark</option>
                    <option value="2">Hendrix</option>
                    <option value="3">Metal</option>
					</select>
                    <button type="submit" class="button2">Submit</button>
    </form>
</div>
</div>
<?php  include 'footer.php';?>