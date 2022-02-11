<?php 

include('config.php');
// Update Data
if(isset($_POST['updated'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE notes SET title='".$title."',description='".$description."' WHERE id = '".$_POST["note_id"]."'";
    if (mysqli_query($con,$query)){
        echo json_encode(array("status" => 1));
    }
    else{
        echo json_encode(array("status"=>2));
    }
}
// Fetch Data
if(isset($_POST["fetch"]) && isset($_POST["note_id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM notes WHERE id = '".$_POST["note_id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);
 }  
?>