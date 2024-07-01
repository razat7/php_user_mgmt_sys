<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
<div class="col-lg-12">
    <div class="card my-2 border-success">
        <div class="card-header bg-warning text-dark">
            <h4 class="m-0"> Notifications </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive notesTable" id="showAllNotifications">
                <!-- <p class="text-center align-self-center lead"> Please wait</p> -->

            </div>
        </div>
    </div>
</div>
<!-- Footer Area -->
            </div>
        </div>
    </div>

    <script type = "text/javascript">

        //fetch notification ajax request
        $(document).ready(function(){
            fetchAllNotifications();
            function fetchAllNotifications(){
                $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {action: 'fetchAllNotifications'},
                success: function(response){
                    $("#showAllNotifications").html(response);
                }
            })
            }

            //check notification
            checkNotification();
                function checkNotification(){
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {action : 'checkNotification'},
                        success:function(response){
                        $("#checkNotification").html(response);
                        }
                    });
                }

              //Remove Notification
              $("body").on("click", ".close", function(e){
                e.preventDefault();
                
                notification_id = $(this).attr('id');

                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: { notification_id: notification_id },
                    success:function(response){
                        fetchAllNotifications();
                        checkNotification();
                        
                    }
                });

             });
        })

    </script>
</body>
</html>