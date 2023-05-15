<?php include 'header.php';
    if(isset($_POST['search_string'])){
        $string=mysqli_real_escape_string($link,$_POST['search_string']);
        $sql = "SELECT username,types.name AS type, strings, girth, tuning FROM user JOIN guitar JOIN types WHERE user.id = user_id AND types.id = types_id AND strings LIKE '%{$_POST['search_string']}%'";
        $result = mysqli_query($link,$sql);
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
    <form action="search_by_strings.php" method="post">
      <div style="margin: auto; padding: 5mm">
      <div>Search by strings</div>
      <input type="text" name="search_string" placeholder="Search by strings">
    <button type="submit" class="button2">Search</button>
    </div>
    </form>
    <table>
        <tr>
          <th>User</th>
          <th>Type</th>
          <th>Strings</th>
		  <th>String Girth</th>
          <th>Tuning</th>
        </tr>
        <?php if(isset($_POST['search_string'])) while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td><?=$row['username']?></td>
                <td><?=$row['type']?></td>
		        <td><?=$row['strings']?></td>
		        <td><?=$row['girth']?></td>
                <td><?=$row['tuning']?></td>
            </tr>
	    <?php endwhile; ?>
      
    </table>

  <?php include 'footer.php';?>