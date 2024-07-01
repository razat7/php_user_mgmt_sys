<?php
require_once 'assets/php/header.php';
?>
    <div class="container">
        <div class="row justify-content-center my-2">
            <div class="col-lg-6 mt-4" id ="showAllNotification">
               
            </div>
        </div>
    </div>
        <!-- <h1> <?= basename($_SERVER["PHP_SELF"]); ?></h1> -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/jquery/sweetalert2.all.min.js"></script>
        <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/DataTables/datatables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //fetch notification of an user

                fetchNotification();
                function fetchNotification(){
                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        data: {action : 'fetchNotification'},
                        success:function(response){
                         $("#showAllNotification").html(response);
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

             //Remove Notification
             $("body").on("click", ".close", function(e){
                e.preventDefault();
                
                notification_id = $(this).attr('id');

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: { notification_id: notification_id },
                    success:function(response){
                        checkNotification();
                        fetchNotification();
                    }
                });

             });
            });
     
        </script>
        </body>
    </html>