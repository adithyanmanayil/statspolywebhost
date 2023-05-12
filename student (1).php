<?php
session_start();
ob_start();
$hostname = "localhost";
$username = "id20575611_localhost";
$password = "hV6[xy)c{74O_wWz";
$database = "id20575611_statspoly";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}
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
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Students's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
	</head>
	
	<body>
		<div class="navbar">
			<div><a href="#">STATSPOLY</a></div>
			<div><a href="index.php">LOGOUT</a></div>
			<div><a href="#grades">GRADES</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#profile">HOME</a></div>
			<div style="clear: both;"></div>
		</div>
		<div class="container" id="profile">
			<div class="row"><div style="height: 4em;"></div></div>
			<div class="row">
				<div class="card-03">
					<h3>HOME</h3>
					<div class="profile xscroll">
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
							echo "<th>Mobile</th>";
							echo "<td>".$row['mobile']."</td>";
							echo "</tr>";

						}
						echo "</table>";
						?>
					</div>
					<div class="row" id="stats"><div class="card-03 num-inputs"></div></div><br>
					<h3>STATS</h3><br>
					<div class="row">
						<?php
						$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
						$result = $conn->query($max_query);
						$row = $result->fetch_assoc();
						$max_value = $row['max_value'];
						
						for($i=1; $i<=$max_value; $i++){
							echo "<div class='card-01' style='float: left; width: 50%'>";
							echo "<h3>SEM".$i." CGPA</h3>";
							$ss="SELECT * FROM results WHERE admn=$user AND sem=$i";
							$rr=$conn->query($ss);
							if($rr->num_rows>0){
								$ror=$rr->fetch_assoc();
								if($ror['verified']==1){
									$s4 = "SELECT registration.admn, subjects.credit, results.grade , results.grade * subjects.credit AS result,
										subjects.credit * 10 AS credits
										FROM subjects
										INNER JOIN results ON subjects.code=results.code
										INNER JOIN registration ON registration.admn=results.admn
										WHERE registration.admn=$user AND results.sem=$i";
									$formatted_cgpa=0;
									$r4 = $conn->query($s4);
									if($r4->num_rows>0){
									$cgpa=0;
									$res=0;
									$div=0;
									while($row4=$r4->fetch_assoc()){
										$s=0;
										$c=0;
										$c=$row4['credits'];
										$s=$row4['result'];
										$div+=$c;
										$res+=$s;
									}
									$cgpa=($res/$div)*10;
									$formatted_cgpa = number_format($cgpa, 2);
									echo $formatted_cgpa;
									}else{
										echo $formatted_cgpa;
									}
								}else{
									echo "Not Verified";
								}
							}else{
								echo "0";
							}
							
							echo "</div>";
						}						
						?>
						<div style="clear: both;"></div>
					</div>
				</div>
			</div>
			<?php
			$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
			$result = $conn->query($max_query);
			$row = $result->fetch_assoc();
			$max_value = $row['max_value'];
			echo"<div  id='grades' class='card-03 num-inputs' style='margin: 0 auto; height: 1em'></div>";
			for($i=1; $i<=$max_value; $i++){
				echo"<div class='card-03' id='s$i' style='padding: 2em;'>";
				echo"<h3>SEMESTER 0$i</h3>";
				echo"<form method=POST style='margin: 2em auto;'>";
				echo"<table style='width: 100%; margin: 0 auto;'>";
				echo"<tr><th style='padding: 0 0.4em;'>CODE</th><th style='padding: 0 0.4em;'>NAME</th><th style='padding: 0 0.4em;'>CREDIT</th><th style='padding: 0 0.4em;'>Imark</th><th>GRADE</th></tr>";
				$sql="SELECT subjects.code, subjects.name, subjects.credit, subjects.sem,
					registration.admn, registration.type, registration.sem,
					results.admn, results.code, results.imark, results.grade, results.sem
					FROM subjects
					INNER JOIN results ON results.code=subjects.code
					INNER JOIN registration ON registration.admn=results.admn
					WHERE registration.admn=$user AND results.sem=$i AND subjects.sem=$i
					ORDER BY subjects.code";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$j=1;
					while($row=$result->fetch_assoc()){
						$ssem = "co" .$i.$j;
						$grade = "g" .$i.$j;
						$simark = "i".$i.$j;
						$d_grade=$row['grade'];
						echo "<tr>";
						echo "<td style='padding: 0.5em; width: 10%;'>
						<input type='text' name='$ssem' value=".$row["code"]." readonly style='font-weight: 700; text-align: center; width: 100%;'>
						</td>";
						echo "<td style='text-align: left; width: 65%;'>".$row["name"]."</td>";
						echo "<td style='width: 7.5%;'>".$row["credit"]."</td>";
						echo "<td style='width: 7.5%;'>";
						echo "<input type='number' name=$simark class='num-inputs' style='text-align: center; width: 100%; margin: 0;'
							value=".$row['imark'].">";
						echo "</td>";
						echo "<td style='width: 10%;'>";
						echo"<select id='$grade' name='$grade' class='dd-inputs' required>";
							echo "<option value='10'";if($d_grade=='10'){echo "selected";}echo ">S</option>";
							echo "<option value='9'";if($d_grade==9){echo "selected";}echo ">A</option>";
							echo "<option value='8'";if($d_grade==8){echo "selected";}echo ">B</option>";
							echo "<option value='7'";if($d_grade==7){echo "selected";}echo ">C</option>";
							echo "<option value='6'";if($d_grade==6){echo "selected";}echo ">D</option>";
							echo "<option value='5'";if($d_grade==5){echo "selected";}echo ">E</option>";
							echo "<option value='0'";if($d_grade==0){echo "selected";}echo ">F</option>";
						echo"</select>";
						echo "</td>";
						echo "</tr>";
						$j++;
					}
				}else{
					$sql="SELECT * FROM subjects where sem=$i AND 'type'=$usertype";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						$j=1;
						while($row=$result->fetch_assoc()){
							$ssem = "co" .$i.$j;
							$grade = "g" .$i.$j;
							$simark = "i".$i.$j;
							echo "<tr>";
							echo "<td style='padding: 0.5em; width: 10%;'>
							<input type='text' name='$ssem' value=".$row["code"]." readonly style='font-weight: 700; text-align: center; width: 100%;'>
							</td>";
							echo "<td style='text-align: left; width: 65%;'>".$row["name"]."</td>";
							echo "<td style='width: 7.5%;'>".$row["credit"]."</td>";
							echo "<td style='width: 7.5%;'>";
							echo "<input type='number' name=$simark class='num-inputs' style='text-align: center; width: 100%; margin: 0;'>";
							echo "</td>";
							echo "<td style='width: 10%;'>";
							echo"<select id='$grade' name='$grade' class='dd-inputs' required>
								<option value='10'>S</option>
								<option value='9'>A</option>
								<option value='8'>B</option>
								<option value='7'>C</option>
								<option value='6'>D</option>
								<option value='5'>E</option>
								<option value='4'>F</option>
							</select>";
							echo "</td>";
							echo "</tr>";
							$j++;
						}
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
							$simark=$_POST["i$i$y"];
							$sql2="SELECT * FROM results WHERE admn='$user' AND code='$scode'";
							$result2=$conn->query($sql2);
							if($result2->num_rows>0){
								$sql21="UPDATE results SET grade='$sgrade' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql21);
								$sql22="UPDATE results SET imark='$simark' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql22);
								$sql23="UPDATE results SET sem='$i' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql23);
							}
							else{
								$sql22="INSERT INTO results (admn, code, grade, imark,verified, sem) VALUES ('$user', '$scode', '$sgrade', '$simark', 0, '$i')";
								$conn->query($sql22);
							}
							$y++;
						}
					}
					header("Location:student.php#s$i");
				}
				echo"</div>";
			}
			?>
		</div>	
	</body>
</html>