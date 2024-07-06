<?php
include 'connection.php';
$url="/crud/home.php";
$pass = false;
// Now you can use the $conn variable for database operations
$user = false;
if ($_POST) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
    
    if ($stmt) {
        // Bind the email parameter to the SQL query
        $stmt->bind_param("s", $email);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();
            
            // Fetch the row
            if ($row = $result->fetch_assoc()) {
                if($password == $row["password"] ){
                    header('Location: '.$url);
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $row["name"];
                    die();
                }else{
                    $pass = true;
                }
                
            } else {
                $user = true;
                // echo "No user found with this email.";
            }
        } else {
            // Fetch and display the error
            echo "Error executing statement: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
<title>SignUp</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Login</h1>
        <?php
        if($user){
        echo "<div style='color:blue; text-align: center'>You don't have an account! Register first</div>";
        }
        if($pass){
            echo "<div style='color:red; text-align: center'>You entered a wrong password!</div>";
            }
        ?>
        <div class="main-agileinfo">
			<div class="agileits-top">
				<form action="/crud/login.php" method="post">
					
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					
					
					<input type="submit" value="LogIn">
				</form>
				<p>Don't have an Account? <a href="/crud/Demo.php"> Register Now!</a></p>
			</div>
		</div>
		
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>