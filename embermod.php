<?php  include 'header.php';?>

<?php
if(isset($_POST['mod_username']) && isset($_POST['genre'])){
	$username = mysqli_real_escape_string($link,$_POST['mod_username']);
	$genre = mysqli_real_escape_string($link,$_POST['genre']);

	$sql = "SELECT username FROM user WHERE username = '$username'";
	$result=mysqli_query($link,$sql);

	if(mysqli_num_rows($result)==0){
		$sql="UPDATE user SET name='$username',genre='$genre' WHERE id='{$_POST['user_id']}'";
		mysqli_query($link,$sql);
		echo "<script> alert('Succesful modification');
		window.location.href = 'index.php';
		</script>";
		}
		else if(mysqli_num_rows($result)==1){
			$row = mysqli_fetch_array($result);
			if($row['username']==$_POST['previous_username']){
				$sql="UPDATE user SET username='$username',genre='$genre' WHERE id='{$_POST['user_id']}'";
				mysqli_query($link,$sql);
				echo "<script> alert('Succesful modification');
				window.location.href = 'index.php';
				</script>";
			}
			else{
				echo "<script> alert('Somebody already exists with this username');
				window.location.href = 'index.php';
				</script>";
			}			
		}
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
		<table class="table-mod">	
			<tr class="tr-mod"  >
				<td class="td-mod" style="background-image:none">Modify</td>
			</tr>
			<form action="embermod.php" method="post">
				<input type=hidden name="previous_username" value="<?php echo $_POST['username'];?>">
			<tr class="tr-mod">
				<td class="td-mod">Username:&nbsp;&nbsp;&nbsp;&nbsp;<input name="mod_username" type="text" value="<?php echo $_POST['username'];?>"  required></td>			
			</tr>
			<tr class="tr-mod">
				<td class="td-mod">Genre:<input name="genre" type="text" value="<?php echo $_POST['genre'];?>"></td>
			</tr>
			<input type="hidden" name="user_id" value="<?php echo $_POST['user_id'];?>">
			<tr class="tr-mod">
				<td class="td-mod">
				<button class="button2" type="submit">
					Submit
				</button>
				</form>
				<a href="index.php">			
				<button class="button2">
					Back
				</button>
				</a>				
				</td>
			</tr>
		</table>
		<?php  include 'footer.php';?>
