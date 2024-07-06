<?php
include 'connection.php';
$insert = false;
session_start();
if(!isset($_SESSION["email"])){
    header('location: /crud/login.php');
}
if($_POST){
    $title = $_POST["title"];
    $data = $_POST["data"];
    $stmt = $conn->prepare("INSERT INTO `notes` (title,data,email) VALUES (?,?,?)");
    
        if($stmt) {
            // Bind parameters to the SQL query
            $stmt->bind_param("sss", $title, $data,$_SESSION["email"]);
            $result = $stmt->execute();
            if($result==true){
                $insert = true;
                
                // echo "data is inserted";
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <div class="container">
        <?php
        include 'navbar.php'
        ?>
        <br>
        <?php
        if($insert){
        echo "<div style='color:green; text-align: center'>Data inserted Successfully!</div>";
        
        }
        ?>
        <br>
<form action="/crud/home.php" method="post">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input required name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title here...">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Content</label>
        <textarea required name="data" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <div class="col-auto mt-3 text-center" >
            <button type="submit" class="btn btn-primary mb-3">Add</button>
          </div>
      </div>
    </form>
    </div>
</body>
</html>