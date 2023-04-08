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

<html>
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Tutor's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
    </head>
    <body>
		<div class="navbar">
			<div><a href="#">STATSPOLY</a></div>
			<div><a href="index.php">LOGOUT</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#verification">VERIFICATION</a></div>
			<div><a href="#toggle">TOGGLE</a></div>
			<div><a href="#home">HOME</a></div>
		</div>
        <div class="container">
		<div class="row" id="home">
				<div class="card-03">
					<h3>HOME</h3>
					<div class="profile" style='overflow-x: scroll;'>
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
							echo "<th>Tutor ID</th>";
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

            <div class="row" id="toggle">
                <div class="card-02">
                    <h3>APPEND STUDENT</h3><br>
                    <center>
                        <form method="POST">
							<input type="number" class="num-inputs" name="admn" id="tid" placeholder="Admission Number">
							<input type="text" class="text-inputs" name="name" id="tname" placeholder="Student Name">
							<input type="number" class="num-inputs" name="mob" id="mob" placeholder="Mobile Number">
							<input type="email" class="text-inputs" name="mail" id="tmail" placeholder="E-Mail"><br>
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
							<input type="submit" name="regstud" class="btn-ppt" value="Save">
						</form>
                        <?php
                        if(isset($_POST['regstud'])){
							$admn=$_POST["admn"];
							$name=$_POST["name"];
							$mob=$_POST["mob"];
                            $mail=$_POST["mail"];
                            $pwd=$_POST["pwd"];
							$ssem=$_POST["sem"];
							$query="SELECT * FROM registration WHERE admn='$admn' AND sem='$ssem'";
							$result=$conn->query($query);
							if(!$result->num_rows>0){
								$sql="insert into registration values('$admn', '$name', '$mob', '$mail', '$pwd', 0, '$ssem', '$user')";
								$conn->query($sql);
							}
							header("Location:tutor.php#div-app");
						}
						?>
                    </center>
                </div>
                <div class="card-02" id="div-rem"><h3>REMOVE STUDENTS</h3>
                    <center>
					<form method="post">
						<input list="your_datalist" name="rvalue" class='text-inputs' placeholder="Student Name">
						<datalist id="your_datalist">
							<?php
							$query = "SELECT * FROM registration WHERE type=0";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value=".$row['name'].">";
							}
							?>
						</datalist>
						<input type="submit" class="btn-ppt" name="srremstud" value="Details"><br>
					</form>
					<div class="yscroll">
					<?php
					$sql="SELECT * FROM registration WHERE sem='$usersem' AND tid='$user'";
					$result=$conn->query($sql);
					if(!isset($_POST['srremstud'])){
						if($result->num_rows>0){
							$z=1;
							while($row=$result->fetch_assoc()){
								echo "<form method='POST'>";
								echo "<table style='width: 100%'>";
								if ($result->num_rows>0){
									echo "<tr>";
									echo "<th style='width: 30%;'>Name</th>";
									echo "<td>".$row['name']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Admn</th>";
									echo "<td><input type='text' name='radmn$z' value=".$row["admn"]." readonly style='font-weight: 500; width: 90%; margin: 0 auto;'></td>";
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
								echo "<input type='submit' class='btn-ppt' name='remstud' value='Remove'>";
								echo "</form>";
							}
						}
					}
					
					if(isset($_POST['srremstud'])){
						$rstud=$_POST['rvalue'];
						$sql="SELECT * FROM registration WHERE name like '%$rstud%' AND sem='$usersem' AND tid='$user'";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$z=1;
							while($row=$result->fetch_assoc()){
								echo "<form method='POST'>";
								echo "<table style='width: 100%'>";
								if ($result->num_rows>0){
									echo "<tr>";
									echo "<th style='width: 30%;'>Name</th>";
									echo "<td>".$row['name']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Admn</th>";
									echo "<td><input type='text' name='radmn$z' value=".$row["admn"]." readonly style='font-weight: 500; width: 90%; margin: 0 auto;'></td>";
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
								echo "<input type='submit' class='btn-ppt' name='remstud' value='Remove'>";
								echo "</form>";
							}
						}
					}
					if (isset($_POST['remstud'])) {
						$z=1;
						$rvalue = $_POST["radmn$z"];
						$query = "DELETE FROM registration WHERE admn = '$rvalue'";
						$result=mysqli_query($conn, $query);
						$query2 = "DELETE FROM results WHERE admn= '$rvalue'";
						$result2=mysqli_query($conn, $query2);
					}
					?>
					</div>
					</center>
                </div>
            </div>
			<div class="row" id="verification">
				<div class="card-03" style="height: 50em; overflow-y: scroll;">
					<h3>VERIFICATION</h3>
					<form method="POST">
					<input list="your_datalist" name="vvalue" class='text-inputs data-inputs'  placeholder="Student Name">
						<?php
						$query = "SELECT * FROM registration WHERE type='0'";
						$result = mysqli_query($conn, $query);
						?>
						<datalist id="your_datalist">
						<?php
						while ($row = mysqli_fetch_array($result)) {
							echo '<option value="' . $row['name'].'">';
						}
						?>
						</datalist>
						<input type="submit" class="btn-ppt" name="vstudent" value="Search">
					</form>
					<?php
					$sql = "SELECT DISTINCT registration.admn
							FROM registration
							INNER JOIN results ON registration.admn = results.admn
							INNER JOIN subjects ON results.code = subjects.code
							WHERE registration.sem = $usersem AND subjects.sem= $usersem AND registration.type=0
							ORDER BY registration.admn";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$z=1;
						while ($row = $result->fetch_assoc()){
							$checkif = 'checkif'.$z;				
							$admn = $row['admn'];
							$sql2 = "SELECT registration.name AS reg_name, results.grade, subjects.name
									FROM registration
									INNER JOIN results ON registration.admn = results.admn
									INNER JOIN subjects ON results.code = subjects.code
									WHERE registration.admn = $admn AND registration.sem = $usersem AND subjects.sem= $usersem
									ORDER BY registration.admn";
							$result2 = $conn->query($sql2);
							$row2=$result2->fetch_assoc();
							echo "<center><div class='card-02' style='width: 100%; margin: 1em auto;'>";
							echo "<h4 style='text-align: left; margin: 0 1em;'>".$row2['reg_name']."</h4>";
							echo "<form method='POST'>";
							echo "<table style='margin: 1em auto; width: 100%; background-color: #555;'>";
							echo "<tr'><th style='padding: 1em;'>Subject Name</th><th>Grade</th></tr>";
							$sql3 = "SELECT registration.name AS reg_name, results.grade, subjects.name
									FROM registration
									INNER JOIN results ON registration.admn = results.admn
									INNER JOIN subjects ON results.code = subjects.code
									WHERE registration.admn = $admn AND registration.sem = $usersem AND subjects.sem= $usersem
									ORDER BY registration.admn";
							$result3 = $conn->query($sql3);
							while ($row3 = $result3->fetch_assoc()) {
								echo "<tr style='background-color: #555;'>";
								echo "<td style='text-align: left;'>" . $row3['name'] . "</td>";
								echo "<td style='text-align: center;'>" . $row3['grade'] . "</td>";
								echo "</tr>";
							}
							echo "</table>";
							echo "<label style='font-weight: 500';>VERIFIED</label><input type='checkbox' name='$checkif'><br>";
							echo "<input type='submit' class='btn-ppt' name='v$checkif' value='Confirm'>";
							echo "</form>";
							if(isset($_POST["v$checkif"])){
								$checkboxValue = isset($_POST["$checkif"]) ? 1 : 0;
								$sql5 = "UPDATE results SET verified='$checkboxValue' WHERE admn=".$row['admn'];
								$conn->query($sql5);
							}
							echo "</div></center>";
							$z++;
						}
					} else {
					echo "No results found.";
					}



					?>
				</div>
			</div>
		</div>

    </body>
</html>

<?php
$conn->close();
?>