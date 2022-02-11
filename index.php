<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ajax Update Data in MySQL By Using Bootstrap Modal - XpertPhp</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>
    <div class="container">
        <h3 align="center">PHP Ajax Update Data in MySQL By Using Bootstrap Modal</h3>
        <br />
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
                <div align="right">
                    <button type="button" class="btn btn-primary text-right m-5" data-toggle="modal" data-target="#addDataModal">Add</button>
                </div>
                <br />
                <div id="employee_table">
                    <table class="table table-bordered">
                        <tr>
                            <th width="70%">Title</th>
                            <th width="15%">Edit</th>
                            <th width="15%">View</th>
                        </tr>
                        <?php 
						include('config.php');
						$query = mysqli_query($con, "SELECT * FROM notes ORDER BY ID DESC");

						while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $row['title'] ?></td>
								<td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
                                <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Data Modal -->
    <div class="modal fade" id="addDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="txtTitle">Title</label>
                        <input type="text" class="form-control" id="txtTitle" name="txtTitle">
                    </div>
                    <div class="form-group">
                        <label for="txtDescription"> Description</label>
                        <textarea class="form-control" id="txtDescription" name="txtDescription" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="add_data" class="btn btn-primary" value="Add">Add</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- View Data Modal-->
    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Note Details</h4>
                </div>
                <div class="modal-body" id="note_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Update data-->
    <div class="modal fade" id="updateDataModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Notes</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
				 <div class="modal-body">
                    <div class="form-group">
                        <label for="txtTitle">Title</label>
                        <input type="text" class="form-control" id="txtTitle" name="txtTitle">
                    </div>
                    <div class="form-group">
                        <label for="txtDescription"> Description</label>
                        <textarea class="form-control" id="txtDescription" name="txtDescription" rows="3"></textarea>
                    </div>
					<input type="hidden" name="note_id" id="note_id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_detail" class="btn btn-primary" value="Update">Update</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function() {
        // add
        $(document).on("click", "#add_data", function() {
            var title = $('#txtTitle').val();
            var description = $('#txtDescription').val();
            $.ajax({
                url: "insert.php",
                type: "POST",
                catch: false,
                data: {
                    added: 1,
                    title: title,
                    description: description
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                        $('#addDataModal').modal().hide();
                        swal("Note successfully Inserted!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });
		// view
        $(document).on('click', '.view_data', function() {
            var note_id = $(this).attr("id");
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: {
                    note_id: note_id
                },
                success: function(data) {
                    $('#note_detail').html(data);
                    $('#dataModal').modal('show');
                }
            });
        });
		// fetch
		$(document).on('click', '.edit_data', function(){  
           var note_id = $(this).attr("id");  
           $.ajax({  
                url:"update.php",  
                method:"POST",  
                data:{fetch: 1,note_id:note_id},  
                dataType:"json",  
                success:function(data){  
                     $('#updateDataModal #txtTitle').val(data.title);  
                     $('#updateDataModal #txtDescription').val(data.description);  
                     $('#updateDataModal #note_id').val(data.id);  
                     $('#updateDataModal').modal('show');  
                }  
           });  
        });
		// update
		$(document).on("click", "#update_detail", function() {
            var title = $('#updateDataModal #txtTitle').val();
            var description = $('#updateDataModal #txtDescription').val();
            var note_id = $('#updateDataModal #note_id').val();
            $.ajax({
                url: "update.php",
                type: "POST",
                catch: false,
                data: {
                    updated: 1,
                    title: title,
                    description: description,
                    note_id: note_id
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                        $('#updateDataModal').modal().hide();
                        swal("Note successfully Updated!", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });		

    });
</script>