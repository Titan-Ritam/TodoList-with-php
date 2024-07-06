<?php
$del=false;
include 'connection.php';
session_start();
if(!isset($_SESSION['email'])) {
header('location:login.php');
}

if (isset($_GET['id'])) {
$stmt1 = $conn->prepare("delete from `notes` where id =?");
$stmt1->bind_param("s",$_GET['id']);
if($stmt1->execute()){
    $del = true;
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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
        include 'navbar.php';
        if($del){
            echo "<div style='color:green; text-align: center'>Notes deleted Successfully</div>";
            }
        $stmt = $conn->prepare("select * from `notes` where email = ?");
        $stmt->bind_param("s",$_SESSION['email']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()) {
                echo '<div class="card mt-3">';
                echo '    <div class="card-body">';
                echo '        <h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>';
                echo '        <p class="card-text">' . htmlspecialchars($row["data"]) . '</p>';
                echo '        <a href="/crud/notes.php?id='. htmlspecialchars($row["id"]).'" class="btn btn-danger">Close</a>';
                echo '        <a href="/crud/update.php?id='. htmlspecialchars($row["id"]).'&title='. htmlspecialchars($row["title"]).'&data='. htmlspecialchars($row["data"]).'" class="btn btn-primary">Update</a>';
                echo '    </div>';
                echo '</div>';
            }
        }    
        ?>

    </div>
</body>
</html>