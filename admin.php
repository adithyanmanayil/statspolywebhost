<?php
$hostname = "localhost";
$username = "id20504209_localhost";
$password = "@D}!g]uExvDWiJ7Z";
$database = "id20504209_statspoly";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['user_admn'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Admin's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
	</head>
	
	<body>
		<div class="navbar">
			<div><a href="#">STATSPOLY</a></div>
			<div><a href="index.php">LOGOUT</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#grades">GRADES</a></div>
			<div><a href="#profile">HOME</a></div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="card-01">
					<h3>ASSIGN TUTOR</h3><br>
					<center>
						<form method="POST">
							<input type="number" class="num-inputs" name="tid" id="tid" placeholder="Tutor ID">
							<input type="text" class="text-inputs" name="tname" id="tname" placeholder="Name">
							<input type="number" class="num-inputs" name="mob" id="mob" placeholder="Mobile Number">
							<input type="email" class="text-inputs" name="tmail" id="tmail" placeholder="E-Mail"><br>
							<div style="margin: 0 auto; letter-spacing: 1em;">
								<h4 style="letter-spacing: 0.2em; font-weight: 600; line-height: 2em;">SEMESTER</h4>
								<label style="letter-spacing: 1.5em; padding-left: 1.5em;">123456</label><br>
								<input type="radio" name="sem" value="1">
								<input type="radio" name="sem" value="2">
								<input type="radio" name="sem" value="3">
								<input type="radio" name="sem" value="4">
								<input type="radio" name="sem" value="5">
								<input type="radio" name="sem" value="6">
							</div>
							<input type="button" class="btn-ppt" value="Generate" onClick="genlogin();"><br>
							<input type="text" class="text-inputs" name="username" id="username" placeholder="Username">
							<input type="text" class="text-inputs" name="pwd" id="pwd" placeholder="Password"><br>
							<input type="submit" class="btn-ppt" value="Save" name="regtutor">
						</form><?php
                        if(isset($_POST['regtutor'])){
							$admn=$_POST["tid"];
							$name=$_POST["tname"];
							$mob=$_POST["mob"];
                            $mail=$_POST["tmail"];
                            $pwd=$_POST["pwd"];
							$tsem=$_POST["sem"];
							$sql="insert into registration values('$admn', '$name', '$mob', '$mail', '$pwd', 1, '$tsem', 0)";
							$conn->query($sql);
							header("Location:admin.php");
						}
						?>
					</center>
				</div>
				<div class="card-01">
					<h3>DEPRIVE TUTOR</h3><br>
				</div>
			</div>
			<div class="row">
				<div class="card-03" id="div-app">
					<h3>APPEND SUBJECTS</h3><br>
					<center>
						<form method="POST">
							<select class="dd-opt" name="subsem">
								<option value='1'>SEMESTER 1</option>
								<option value='2'>SEMESTER 2</option>
								<option value='3'>SEMESTER 3</option>
								<option value='4'>SEMESTER 4</option>
								<option value='5'>SEMESTER 5</option>
								<option value='6'>SEMESTER 6</option>
							</select><br>
							<input type="number" class="num-inputs" id="subcode" name="subcode" placeholder="Subject Code">
							<input type="text" class="text-inputs" id="subname" name="subname" placeholder="Subject Name">
							<input type="text" class="text-inputs" id="subcredit" name="subcredit" placeholder="Credit">
							<input type="submit" class="btn-ppt" name='subsubmit' value="Save" onClick="save();">
						</form>
						<?php
						if(isset($_POST['subsubmit'])){
							if(isset($_POST['subsem'])){
								$isubsem=$_POST['subsem'];
							}
							$isubcode=$_POST["subcode"];
							$isubname=$_POST["subname"];
							$isubcredit=$_POST["subcredit"];
							$sql="insert into subjects values('$isubcode', '$isubname', '$isubcredit', '$isubsem')";
							$conn->query($sql);
							header("Location:admin.php#div-app");
						}
						?>	
					</center>
				</div>
			</div>
			<div class="row">
				<div class="card-03" id="div-rem">
					<h3>REMOVE SUBJECTS</h3><br>
					<center>
					<form method="post">
						<input list="stud_datalist" name="value" class='text-inputs' placeholder="Subject Name">
						<datalist id="stud_datalist">
							<?php
							$query = "SELECT name FROM subjects";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo '<option value="' . $row['name'] . '">';
							}
							?>
						</datalist>
						<?php echo'<a href="#div-app"><input type="submit" class="btn-ppt" name="remsub" value="Remove"></a>'?>
					</form>
					<?php
					if (isset($_POST['remsub'])) {
						$value = $_POST['value'];
						$query = "DELETE FROM subjects WHERE name = '$value'";
						mysqli_query($conn, $query);
						$query2 = "DELETE FROM results WHERE name = '$value'";
						mysqli_query($conn, $query2);
						header("Location:admin.php#div-rem");
					}
					$conn->query($query);
					?>
					</center>
				</div>
			</div>
		</div>
	</body>
</html>