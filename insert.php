<?php 

include('config.php');
// Add Data
if(isset($_POST['added'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "INSERT INTO notes(title,description,created_at) VALUES ('$title','$description',NOW())";
    if (mysqli_query($con,$query)){
        echo json_encode(array("status" => 1));
    }
    else{
        echo json_encode(array("status"=>2));
    }
}
// View Data
if(isset($_POST["note_id"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM notes WHERE id = '".$_POST["note_id"]."'";  
      $result = mysqli_query($con, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">'.$row["title"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Description</label></td>  
                     <td width="70%">'.$row["description"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Date</label></td>  
                     <td width="70%">'.$row["created_at"].'</td>  
                </tr>  
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
?>