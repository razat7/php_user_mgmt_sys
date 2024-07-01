<?php
require_once 'assets/php/admin-header.php';
?>
<div class="row">
   <div class="col-lg-12">
    <div class="card my-2 border-success">
        <div class="card-header bg-warning text-dark">
            <h4 class="m-0"> Feedback </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive notesTable" id="showAllFeedback">
                <!-- <p class="text-center align-self-center lead"> Please wait</p> -->

            </div>
        </div>
    </div>
   </div>
</div>
 <!-- Reply feedback Modal  -->
    <div class="modal fade" id="showReplyModal">.modal('hide');

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reply</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" class="px-3" id="feedback-reply-form">
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Write Your Reply..."></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name ="submit" value="Send Reply" class="btn btn-primary btn-block" id="feedbackReplyBtn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Footer Area -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            fetchAllFeedback();

            //ajax request to fetch feedback data

            function fetchAllFeedback(){
                $.ajax({
                    url: 'assets/php/admin-action.php',
                    method: 'post',
                    data: {action: 'fetchAllFeedback'},
                    success: function(response){
                        $("#showAllFeedback").html(response);
                        $("table").DataTable({
                        order: [0, 'desc']
                       });
                    }
                });
            }

            //ajax request to delete feedback
            $("body").on("click", ".deleteFeedbackIcon", function(e){
                e.preventDefault();

                delete_id = $(this).attr('id');
                Swal.fire({
                        title: 'Are You Sure, You Want To Delete This Feedback ?',                        
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
                                        'Feedback Deleted Successfully',
                                        'Success'
                                    )
                                    fetchAllFeedback();
                            }
                        });
                           
                        }
                    });
            });

            //Get the current row user id
            var uid;
            var fid;
            $("body").on("click", ".replyFeedbackBtn", function(e){
                uid = $(this).attr('id');
                fid = $(this).attr('fid');
            });

            //Ajax request to reply feedback

            $("#feedbackReplyBtn").click(function(e){
                if($("#feedback-reply-form")[0].checkValidity()){
                    let message = $("#message").val();
                    e.preventDefault();
                    $("#feedbackReplyBtn").val("Please Wait...");

                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {uid: uid, message: message, fid: fid},
                        success: function(response){
                            $("#feedbackReplyBtn").val("Send Reply");
                            $("#showReplyModal").modal('hide');
                            $("#feedback-reply-form")[0].reset();

                            Swal.fire(
                                'Sent !',
                                'Reply Sent Successfully',
                                'success'
                            )
                            fetchAllFeedback();
                          
                        }
                    });
                }
            });

        }); 

           
    </script>
</body>
</html>