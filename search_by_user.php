<?php include 'header.php';?>
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
	$sql="SELECT * FROM user";
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
    ?>

  <form action="search_by_user.php" method="post">
      <div style="margin: auto; padding: 5mm">
      <div>Search by users</div>
    <select name = "searched_user">
	<?php while($row = mysqli_fetch_array($result)): ?>
		<option value = "<?=$row['id']?>"><?=$row['username']?></option>
	<?php endwhile; ?>
	</select>
    <button type="submit" class="button2">Submit</button>
    </div>
    
    </form>
    <?php
    if(isset($_POST['searched_user'])){
        $sql="SELECT * FROM guitar INNER JOIN types ON types_id = types.id WHERE guitar.user_id = '{$_POST['searched_user']}'";
        $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    }
    
    ?>
    <table>
        <tr>
          <th>Type</th>
          <th>Strings</th>
          <th>String Girth</th>
		  <th>Tuning</th>
        </tr>
        <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['strings']?></td>
		        <td><?=$row['girth']?></td>
		        <td><?=$row['tuning']?></td>
            </tr>
	    <?php endwhile; ?>
        
    </table>

  <?php include 'footer.php';?>