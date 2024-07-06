<?php
include 'connection.php';
if(isset($_GET['title'])){
$id = $_GET['id'];
$title = $_GET['title'];
$data = $_GET['data'];
}
if(isset($_GET['utitle']) && isset($_GET['udata'])){
    $noteId=$_GET['note_id'];
     $updatedTitle = $_GET['utitle'];
     $updatedData = $_GET['udata'];
     echo $updatedData.$updatedTitle;

     $stmt = $conn->prepare("UPDATE `notes` SET `title` = ?, `data` = ? WHERE `id` = ?");
     if($stmt) {
     $stmt->bind_param("sss",$updatedTitle,$updatedData,$noteId);
     if($stmt->execute()){
        header('location:/crud/notes.php');
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
    <title>Update</title>
</head>
<body>
    <div class="container">
        <?php
        include 'navbar.php';
        ?>
    <h1 class="text-center">Update</h1>
    <form action="/crud/update.php" method="get">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input required name="utitle" type="text" class="form-control" id="exampleFormControlInput1" value=<?php echo htmlspecialchars($title); ?> >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea required  name="udata" class="form-control" id="exampleFormControlTextarea1" rows="3" ><?php echo htmlspecialchars($data); ?></textarea>
            <div class="col-auto mt-3 text-center" >
                <button type="submit" class="btn btn-primary mb-3">Update</button>
            </div>
            <input name="note_id" style="display: none" value=<?php echo htmlspecialchars($id); ?> >
        </div>
    </form>

    </div>
</body>
</html>