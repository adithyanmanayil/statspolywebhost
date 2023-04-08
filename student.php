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
$user=$_SESSION['user_admn'];
$usersem=$_SESSION['user_sem'];
$usertype=$_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale-1.0">
		<title>Students's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
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
			<h3 style="font-size: 3em; letter-spacing: 0.5em;">STATSPOLY</h3>
			<h3 style="line-height: 3em;" id="profile">-SEEK EASY!</h3>
			<div class="row" id="profile">
				<div class="card-03">
					<h3>HOME</h3>
					<div class="profile">
						<?php
						$sql="SELECT * FROM registration WHERE admn=".$_SESSION['user_admn'];
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						
						echo "<table>";
						if ($result->num_rows>0){
							echo "<tr>";
							echo "<th>Name</th>";
							echo "<td>".$row['name']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>Admission Number</th>";
							echo "<td>".$row['admn']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>Mail ID</th>";
							echo "<td>".$row['mail']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th id='grades'>Mobile</th>";
							echo "<td>".$row['mobile']."</td>";
							echo "</tr>";

						}
						echo "</table>";
						?>
					</div>
				</div>
			</div>
			
			<?php
			$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
			$result = $conn->query($max_query);
			$row = $result->fetch_assoc();
			$max_value = $row['max_value'];
			
			for($i=1; $i<=$max_value; $i++){
				echo"<div class='card-03' style='padding: 2em;'>";
				echo"<h3>SEMESTER 0$i</h3>";
				echo"<form method=POST style='margin: 2em auto;'>";
				echo"<table style='width: 100%; margin: 0 auto; border=0;'>";
				echo"<tr><th>CODE</th><th>NAME</th><th>CREDIT</th><th colspan='7'>GRADE</th></tr>";
				echo"<tr><td></td><td></td><td></td><td style='letter-spacing: 1em; padding-left: 0.8em;'>SABCDEF</td>";
				$sql="SELECT * FROM subjects where sem=$i AND 'type'=$usertype";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$j=1;
					while($row=$result->fetch_assoc()){
						$ssem = "co" .$i.$j;
						$grade = "g" .$i.$j;
						echo "<tr>";
						echo "<td style='padding: 1em; width: 10%;'>
						<input type='text' name='$ssem' value=".$row["code"]." readonly style='font-weight: 700; text-align: center; width: 100%;'>
						</td>";
						echo "<td style='text-align: left; width: 50%;'>".$row["name"]."</td>";
						echo "<td style='width: 5%;'>".$row["credit"]."</td>";
						echo "<td style='width: 35%;'>";
						echo "<input type='radio' name='$grade' value='S' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='A' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='B' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='C' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='D' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='E' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='F' style='margin: 0 0.5em;'>";
						echo "</td>";
						echo "</tr>";
						$j++;
					}
				}
				echo "</table>";
				echo "<input type='submit' class='btn-ppt' name='sem$i' value='Save'>";
				echo "</form>";
				if(isset($_POST["sem$i"])){
					$sql="SELECT * FROM subjects where sem=$i";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						$y=1;
						while($row=$result->fetch_assoc()){
							$scode=$_POST["co$i$y"];
							$sgrade=$_POST["g$i$y"];
							$sql2="SELECT * FROM results WHERE admn='$user' AND code='$scode'";
							$result2=$conn->query($sql2);
							if($result2->num_rows>0){
								$sql21="UPDATE results SET grade='$sgrade' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql21);
							}
							else{
								$sql22="INSERT INTO results (admn, code, grade) VALUES ('$user', '$scode', '$sgrade')";
								$conn->query($sql22);
							}
							$y++;
						}
					}
				}
				echo"</div>";
			}
			?>
		</div>	
	</body>
</html>