<?php
include 'connection.php';

if($_POST){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    
    $stmt1 = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
    if ($stmt1) {
        // Bind the email parameter to the SQL query
        $stmt1->bind_param("s", $email);
        
        // Execute the statement
        if ($stmt1->execute()) {
            // Get the result
            $result = $stmt1->get_result();
        
        if ($result->num_rows > 0) {
            $emailis = true;
        }else{

        }

$stmt = $conn->prepare("INSERT INTO `user` (name, email, password, role) VALUES (?, ?, ?, ?)");
$url="/crud/home.php";

    if($stmt) {
        // Bind parameters to the SQL query
        $stmt->bind_param("ssss", $name, $email, $password, $role);
        
        if($stmt->execute()==true){
        $submit = true;
        // header('Location: '.$url);
        // die();
        }else{
            $notsubmit = true;
        }
    }else {
        echo "Error: " . $stmt->error;
    }
}
}
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
		<h1>SignUp</h1>
        <?php
        if($submit){
        echo "<div style='color:green; text-align: center'>Form Submitted Successfully</div>";
        }
        if($notsubmit)
        {
            echo "<div style='color:red; text-align: center'>Something Went Wrong</div>";
        }
        if($emailis)
        {
            echo "<div style='color:blue; text-align: center'>you Allready register</div>";
        }
        ?>
        <div class="main-agileinfo">
			<div class="agileits-top">
				<form action="/crud/Demo.php" method="post">
					<input class="text" type="text" name="name" placeholder="name" required="">
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<input class="text" style="margin-top:30px" type="text" name="role" placeholder="Role" required="">
					
					<input type="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a href="/crud/login.php">Login Now!</a></p>
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