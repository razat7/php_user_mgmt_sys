<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
<div class="col-lg-12">
    <div class="card my-2 border-danger">
        <div class="card-header bg-danger text-white">
            <h4 class="m-0"> Total Deleted Users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive notesTable" id="showAllDeletedUsers">
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
             //fetch all deletd users
             fetchAllDeletedUsers();
            
            function fetchAllDeletedUsers(){
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { action: 'fetchAllDeletedUsers' },
                    success: function(response){
                       $("#showAllDeletedUsers").html(response);
                       $("table").DataTable({
                        order: [0, 'desc']
                       });
                    }
                });
            }
            //delete the data from table
            $("body").on("click", ".restoreUserIcon", function(e){
                    e.preventDefault();

                    res_id = $(this).attr('id');

                Swal.fire({
                        title: 'Are You Sure, You want to reactivate the user ?',                        
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Activate'
                    }).then((result) => {
                        if(result.value){
                            $.ajax({
                            url: 'assets/php/admin-action.php',
                            method: 'post',
                            data: {res_id: res_id},
                            success:function(response){
                                Swal.fire(
                                        'User Reactivated Successfully',
                                        'Success')
                                    fetchAllDeletedUsers();
                            }
                        });
                           
                        }
                    });
            });

        });

    </script>
</body>
</html>