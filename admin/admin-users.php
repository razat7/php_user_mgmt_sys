<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
   <div class="col-lg-12">
    <div class="card my-2 border-success">
        <div class="card-header bg-success text-white">
            <h4 class="m-0"> Total Registered Users</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive usersTable" id="showAllUsers">
                <!-- <p class="text-center align-self-center lead"> Please wait</p> -->

            </div>
        </div>
    </div>
   </div>
</div>
<!-- Display User's in details -->
<div class="modal fade" id="showUserDetailsModal">
    <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="getName"></h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>
            <div class="modal-body">
                <div class="card-deck">
                    <div class="card border-primary">
                        <div class="card-body">
                            <p id="getname"></p>
                            <p id="getPhone"></p>
                            <p id="getDob"></p>
                            <p id="getGender"></p>
                            <p id="getCreated"></p>
                            <p id="getVerified"></p>
                        </div>
                    </div>
                    <div class="card align-self-center" id="getImage"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

            //fetch all users
            fetchAllUsers();
            
            function fetchAllUsers(){
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { action: 'fetchAllUsers' },
                    success: function(response){
                       $("#showAllUsers").html(response);
                       $("table").DataTable({
                        order: [0, 'desc']
                       });
                    }
                });
            }

        //display to fetch data in details
        $("body").on("click", ".userDetailsIcon", function(e){
                    e.preventDefault();
                    details_id = $(this).attr('id');
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {details_id: details_id},
                        success:function(response){
                            data = JSON.parse(response);
                            $("#getName").text(data.name+''+'(ID:'+data.id+')');
                            $("#getname").text('Name :'+data.name);
                            $("#getPhone").text('Phone :'+data.phone);
                            $("#getDob").text('DOB :'+data.dob);
                            $("#getGender").text('Gender :'+data.gender);
                            $("#getCreated").text('Joined On :'+data.created_at);
                            $("#getVerified").text('Verified On :'+data.verified);

                            if(data.photo != ''){
                                $("#getImage").html('<img src="../assets/php/'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="280px">');
                            }
                            else{
                                $("#getImage").html('<img src="../assets/img/ard.jpg'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="280px">');
                            }
                        }
                    });
                });

                //delete the data from table
                 $("body").on("click", ".userDeleteIcon", function(e){
                    e.preventDefault();

                    delete_id = $(this).attr('id');

                    Swal.fire({
                        title: 'Are You Sure, You Want To Delete This User ?',                        
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
                                        'User Deleted Successfully',
                                        'Success'
                                    )
                                    fetchAllUsers();
                            }
                        });
                           
                        }
                    });
            });


            });    
    </script>
</body>
</html>