<?php  include 'header.php';?>
<?php
if(isset($_POST['guitar_id'])){
	$_SESSION['mod_guitar']=1;
	$sql="SELECT * FROM guitar WHERE id='{$_POST['guitar_id']}'";
	$result = mysqli_query($link,$sql);
	$guitar=mysqli_fetch_array($result);
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
			<tr class="tr-mod">
				<td class="td-mod">Modify</td>
			</tr>
			<tr class="tr-mod">
				<td class="td-mod">Type:
					<?php
					$sql="SELECT * FROM types";
					$result = mysqli_query($link, $sql) or die(mysqli_error($link));
					?>
					<form action="guitar.php" method="post">
					<select name = "type">
					<?php while($row = mysqli_fetch_array($result)): ?>
					   <option value = "<?=$row['id']?>"><?=$row['name']?></option>
					<?php endwhile; ?>
					</select>
				 
				</td>			
			</tr>

			<tr class="tr-mod">
				<td class="td-mod">Strings:<input name="strings" type="text" value="<?php if(isset($_POST['guitar_id'])){echo $guitar['strings'];}?>" required></td>
			</tr>
			<tr class="tr-mod">
				<td class="td-mod">Girth:<input name="girth" type="number" min="6" value="<?php if(isset($_POST['guitar_id'])){echo $guitar['girth'];}?>" required></td>
			</tr>
			<tr class="tr-mod">
				<td class="td-mod">Tuning:<input name="tuning" type="text" value="<?php if(isset($_POST['guitar_id'])){echo $guitar['tuning'];}?>" required></td>
			</tr>
			<tr class="tr-mod">
				<td class="td-mod">
					<button class="button2" type="submit"> Submit</button>
				<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
				<input type="hidden" name="guitar_id" value="<?php if(isset($_POST['guitar_id'])){ echo $_POST['guitar_id']; }?>">
				</form>
				<form action="guitar.php" method="post">				
					<input type="hidden" class="input-hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">
					<input type="hidden" name="mod_canceled" value=1>
					<button class="button2" type="submit">Back<button>				
					</form>				
				</td>
			</tr>
		</table>
		<?php  include 'footer.php';?>
