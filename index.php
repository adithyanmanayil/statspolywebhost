<?php
$hostname = "localhost";
$username = "id20504209_localhost";
$password = "@D}!g]uExvDWiJ7Z";
$database = "id20504209_statspoly";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Login's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
	</head>
    <body>
        <div class="container">
			<div class="row">
				<div class="card-02 login" style="margin: 5em auto;">
                    <h3 style='font-size: 20px;'>STATSPOLY</h3>
                    <h3 style='font-size: 10px;'>SEEK EASY</h3><br>
                    <center>
                        <form method="POST">
                            <h3>LOGIN</h3>
                            <input type="number" class='num-inputs' name='user' placeholder='Username'><br>
                            <input type="password" class='text-inputs' name='pwd' placeholder='Password'><br>
                            <input type="submit" class='btn-ppt' value='Login' name='login'>
                        </form>
                        <?php
                        session_start();
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if(isset($_POST['login'])){
                                $user=$_POST['user'];
                                $pwd=$_POST['pwd'];
                                $sql="SELECT * FROM registration WHERE password='$pwd' AND mobile='$user'";
                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    if ($row['mobile']==$user){
                                        $_SESSION['user_admn'] = $row['admn'] ;
                                        $_SESSION['user_sem'] = $row['sem'] ;
                                        $_SESSION['user_type'] = $row['type'] ;
                                        if($row['type']==0){
                                            header("Location:student.php");
                                        }
                                        if($row['type']==1){
                                            header("Location:tutor.php");
                                        }
                                        if($row['type']==2){
                                            header("Location:admin.php");
                                        }
                                        exit;
                                    }
                                }
                            }
                        }
                        ?>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>