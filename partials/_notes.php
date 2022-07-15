<?php   $user =  $_SESSION['username'];?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
</head>

<body>





    <!-- mynotes code -->
    <?php  
// INSERT INTO `notes` (`id`, `tittle`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "mynotes";

// Create a connection

include 'partials/_dbconnect.php';
// Die if connection was not successful
if (!$conn){
die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
$id = $_GET['delete'];
$delete = true;
$sql = "DELETE FROM `notes` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
// Update the record
$id = $_POST["snoEdit"];
$tittle = $_POST["titleEdit"];
$description = $_POST["descriptionEdit"];

// Sql query to be executed
$sql = "UPDATE `notes` SET `tittle` = '$tittle' , `description` = '$description' WHERE `notes`.`id` = $id";
$result = mysqli_query($conn, $sql);
if($result){
$update = true;
}
else{
echo "We could not update the record successfully";
}
}
else{
$tittle = $_POST["tittle"];
$description = $_POST["description"];

// Sql query to be executed
// $sql = "INSERT INTO `notes` (`tittle`, `description`) VALUES ('$tittle', '$description')";
$sql = "INSERT INTO `notes` (`id`, `tittle`, `description`, `username`, `dt`) VALUES (NULL, '$tittle', '$description','$user' , current_timestamp());";
$result = mysqli_query($conn, $sql);


if($result){ 
$insert = true;
}
else{
echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
} 
}
}
?>

    <!doctype html>
   

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">





    <body>


        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-tittle" id="editModalLabel">Edit this Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true"></span>
  </button>
                    </div>
                    <form action="/mynotes/index.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <div class="form-group">
                                <label for="tittle">Note tittle</label>
                                <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group">
                                <label for="desc">Note description</label>
                                <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer d-block mr-auto">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <?php
if($insert){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success!</strong> Your note has been inserted successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>×</span>
</button>
</div>";
}
?>
            <?php
if($delete){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success!</strong> Your note has been deleted successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>×</span>
</button>
</div>";
}
?>
                <?php
if($update){
echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success!</strong> Your note has been updated successfully
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>×</span>
</button>
</div>";
}
?>
                    <div class="container my-4">
                        <h2>Add a Note to mynotes</h2>
                        <form action="/mynotes/index.php" method="POST">
                            <div class="form-group">
                                <label for="tittle">Note tittle</label>
                                <input type="text" class="form-control" id="tittle" name="tittle" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group">
                                <label for="desc">Note description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Note</button>
                        </form>
                        
                    </div>

                    <div class="container my-4">


                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">tittle</th>
                                    <th scope="col">description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
     <?php 
  $user = $_SESSION['username'];

  $sql = "SELECT * FROM `notes` where username = '$user'; ";
  $result = mysqli_query($conn, $sql);
  $id = 0;
  while($row = mysqli_fetch_assoc($result)){
    $id = $id + 1;
    echo "<tr>
    <th scope='row'>". $id . "</th>
    <td>". $row['tittle'] . "</td>
    <td>". $row['description'] . "</td>
    <td> <button class='edit btn btn-sm btn-primary' id=".$row['id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button>  </td>
  </tr>";
} 
  ?>


                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <!-- Optional JavaScript -->
                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
                    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#myTable').DataTable();

                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            $('#myTable').DataTable();

                        });
                    </script>
                    <script>
                        edits = document.getElementsByClassName('edit');
                        Array.from(edits).forEach((element) => {
                            element.addEventListener("click", (e) => {
                                console.log("edit ");
                                tr = e.target.parentNode.parentNode;
                                tittle = tr.getElementsByTagName("td")[0].innerText;
                                description = tr.getElementsByTagName("td")[1].innerText;
                                console.log(tittle, description);
                                titleEdit.value = tittle;
                                descriptionEdit.value = description;
                                snoEdit.value = e.target.id;
                                console.log(e.target.id)
                                $('#editModal').modal('toggle');
                            })
                        })

                        deletes = document.getElementsByClassName('delete');
                        Array.from(deletes).forEach((element) => {
                            element.addEventListener("click", (e) => {
                                console.log("edit ");
                                id = e.target.id.substr(1);

                                if (confirm("Are you sure you want to delete this note!")) {
                                    console.log("yes");
                                    window.location = `/mynotes/index.php?delete=${id}`;
                                    // TODO: Create a form and use post request to submit a form
                                } else {
                                    console.log("no");
                                }
                            })
                        })
                    </script>