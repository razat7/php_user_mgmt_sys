<?php
require_once 'assets/php/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if($verified == 'Not Verified !'): ?>
            <div class="alert alert-danger alert-dismissible text-center mt-2 m-0"> 
            <button class="close" type="button" data-dismiss ="alert">&times;</button>
            <strong> Your E-mail is not verified !</strong>
            </div>
        </div>
        <?php endif; ?>
        <!-- <h4 class="text-center text-primary mt-2" style="font-family:kalimati;">" यतो धर्मस्तताे जय "</h4> -->
    </div>
</div>
    <div class="card">
        <h5 class="card-header bg-primary d-flex justify-content-between">
            <span class="text-light lead align-self-center"  style="font-family:kalimati">Note Details</span>
            <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addNoteModal"  style="font-family:kalimati"> <i class="fas fa-plus-circle fa-lg"> </i> &nbsp;Add Note </a>
        </h5>
        <div class="card-body">
            <div class="table-responsive" id="showNote" style="font-family:kalimati; text-align:center;">
            </div>
        </div>
    </div>

    <!-- Start Add New Note Modal -->
    <div class="modal fade" id="addNoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-light"  style="font-family:kalimati">Notes</h4>
                    <button type ="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="add-note-form" class="px-3">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Note Title" required>
                        </div>
                        <div class="form-group">
                            <textarea name="note"  class="form-control form-control-lg" placeholder="Enter Note Details" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block btn-lg" name="addNote" id="addNoteBtn" Value="Add Note">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add New Note Modal -->

    <!-- Start Edit New Note Modal -->
    <div class="modal fade" id="editNoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-light">Edit Note Details</h4>
                    <button type ="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="edit-note-form" class="px-3">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <textarea name="note"  id="note" class="form-control form-control-lg" placeholder="Your notes here....." rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block btn-lg" name="editNoteBtn" id="editNoteBtn" Value="Update Note">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Edit New Note Modal -->

    <!-- Details of note modal -->
    <div class="modal fade" id="detailNoteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-dark"></h4>
                    <button type ="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  
                </div>
            </div>
        </div>
    </div>
    <!-- End of details in modal -->



 <!-- <h1> <?= basename($_SERVER["PHP_SELF"]); ?></h1> -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/jquery/sweetalert2.all.min.js"></script>
        <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/DataTables/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("table").DataTable();
      
            //ajax request to add new notes
            $("#addNoteBtn").click(function(e){
                if($("#add-note-form")[0].checkValidity()){
                    e.preventDefault();

                    $("#addNoteBtn").val("Please wait...");
                    
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        data : $("#add-note-form").serialize()+'&action=add_note',
                        success:function(response){
                            $("#addNoteBtn").val("Add Note");
                            $("#add-note-form")[0].reset();
                            $("#addNoteModal").modal('hide');
                            Swal.fire({
                                title: 'Note Added Successfully',
                                type: 'success'
                            });
                            displayAllNotes();
                        }
                    });
                }
            });
           
            //edit note of an user Ajax request
            $("body").on("click", ".editBtn", function(e){
                e.preventDefault();

                edit_id = $(this).attr('id');
               
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: {edit_id: edit_id},
                    success:function(response){
                        data = JSON.parse(response);
                        $("#id").val(data.id);
                        $("#title").val(data.title);
                        $("#note").val(data.note);
                        $("#faculty").val(data.faculty);
                        // console.log(data);
                    }
                });
            });

            //update note of an user ajax request
            $("#editNoteBtn").click(function(e){
                if($("#edit-note-form")[0].checkValidity()){
                    e.preventDefault();

                    $("#editNoteBtn").val("Please wait...");
                    
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        data : $("#edit-note-form").serialize()+'&action=update_note',
                        success:function(response){
                            $("#editNoteBtn").val("Update Note");
                            $("#edit-note-form")[0].reset();
                            $("#editNoteModal").modal('hide');
                            Swal.fire({
                                title: 'Note Updated Successfully',
                                type: 'success'
                            });
                            displayAllNotes();
                        }
                    });
                }
            });

            //delete the data from table
            $("body").on("click", ".deleteBtn", function(e){
                e.preventDefault();

                delete_id = $(this).attr('id');

                Swal.fire({
                        title: 'Are You Sure ?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: 'Yes, delete it!',
                        type: 'success',
                    }).then((result) => {
                        if(result.value){
                            $.ajax({
                            url: 'assets/php/process.php',
                            method: 'post',
                            data: {delete_id: delete_id},
                            success:function(response){
                                Swal.fire({
                                        title: 'Note Deleted Successfully',
                                        type: 'success'
                                    });
                                    displayAllNotes();
                            }
                        });
                           
                        }
                    });
            });

            //function to fetch data in details
            $("body").on("click", ".infoBtn", function(e){
                e.preventDefault();
                info_id = $(this).attr('id');
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: {info_id: info_id},
                    success:function(response){
                        data = JSON.parse(response);
                       Swal.fire({
                            title: '<strong> Note : ID('+data.id+')</strong>',
                            type: 'info',
                            html: '<b>Title : </b>'+data.title+'<br><br><b>Note : </b>'+data.note+
                            '<br><br><b> Written On : </b>'+data.created_at+'<br><br><b>Updated On : </b>'+data.updated_at,
                            showCloseButton: true,
                       });
                 
                        // console.log(response);
                    }
                });

            });            
            // function to fetch data in a table of home page
            displayAllNotes();
            function displayAllNotes (){
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: {action: 'display_notes'},
                    success:function(response){
                        $("#showNote").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }
            //check notification
            checkNotification();
                function checkNotification(){
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        data: {action : 'checkNotification'},
                        success:function(response){
                        $("#checkNotification").html(response);
                        }
                    });
                }
                //checking bug errors
                $.ajax({
                    url: 'assets/php/action.php',
                    method: 'post',
                    data: {action: 'checkUser' },
                    success: function(response){
                        if(response === 'bye'){
                            window.location = 'index.php';
                        }
                    }
                });
        });

        </script>
        </body>
    </html>