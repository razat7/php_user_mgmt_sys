<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
   <div class="col-lg-12">
    <div class="card my-2 border-success">
        <div class="card-header bg-success text-white">
            <h4 class="m-0"> Notes </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive notesTable" id="showAllNotes">
                <!-- <p class="text-center align-self-center lead"> Please wait</p> -->

            </div>
        </div>
    </div>
   </div>
</div>
<!-- Footer Area -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //fetch all notes ajax request
            fetchAllNotes();

            function fetchAllNotes(){
                $.ajax({
                    url:'assets/php/admin-action.php',
                    method: 'post',
                    data: { action : 'fetchAllNotes' },
                    success:function(response){
                       $("#showAllNotes").html(response);
                        $("table").DataTable({
                        order: [0, 'desc']
                       });
                    }
                });

            }

            //delete the data from table
            $("body").on("click", ".deleteNoteIcon", function(e){
                    e.preventDefault();
                    
                    delete_id = $(this).attr('id');

                    Swal.fire({
                        title: 'Are You Sure, You Want To Delete This Note ?',                        
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete'
                    }).then((result) => {
                        if(result.value){
                            $.ajax({
                            url: 'assets/php/admin-action.php',
                            method: 'post',
                            data: {delete_id: delete_id},
                            success:function(response){
                                Swal.fire(
                                        'Note Deleted Successfully',
                                        'Success'
                                    )
                                    fetchAllNotes();
                            }
                        });
                           
                        }
                    });
            });
        });

    </script>
</body>
</html>