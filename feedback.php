<?php
require_once 'assets/php/header.php';
?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-3">
                <?php if($verified == 'Verified !'):?>
                    <div class="card border-primary">
                        <div class="card-header lead text-center bg-primary text-white">
                            Send Your feedback !
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" class="px-4" id="feedback-form">
                                <div class="form-group">
                                  <input type="text" name="subject" placeholder ="Enter your subject" class="form-control-lg form-control rounded-0" required> 
                                </div>
                                <div class="form-group">
                                    <textarea name="feedback" class="form-control-lg form-control rounded-0" placeholder="Write Your Feedback Here...." rows="8" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="feedbackBtn" id="feedbackBtn" class="form-control-lg form-control rounded-0" value="Send">
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <h1 class="text-center text-secondary mt-5">Only Verified Users Can Send Their Feedback !</h1>
        <?php endif; ?>


        <!-- <h1> <?= basename($_SERVER["PHP_SELF"]); ?></h1> -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/jquery/sweetalert2.all.min.js"></script>
        <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script src="assets/DataTables/datatables.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){
                //send feedback to admin ajax request

                $("#feedbackBtn").click(function(e){
                    if($("#feedback-form")[0].checkValidity()){
                     e.preventDefault();

                    $(this).val("Please Wait...");

                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        data: $("#feedback-form").serialize()+'&action=feedback',
                        success: function(response){
                        console.log(response);
                        $("#feedbackBtn").val("Send");
                        $("#feedback-form")[0].reset();
                        Swal.fire({
                            title: 'Feedback Sent Successfully !',
                            type: 'success'
                        });
                        }
                    });
                    }
                });
            });
           
        </script>
        </body>
    </html>