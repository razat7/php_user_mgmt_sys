<?php
require_once 'assets/php/header.php';
?>
<div class="container">
    <div class=" row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs ">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editprofile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Profile tab content start -->
                        <div class="tab-pane container active" id="profile">
                            <div id="verifyEmailAlert" class="text-danger"></div>
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?= $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Name : </b> <?= $cname;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Email : </b> <?= $cemail;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Gender : </b> <?= $cgender;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Date Of Birth : </b> <?= $cdob;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Phone : </b> <?= $cphone;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Registered On : </b> <?= $reg_on;?> </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"> <b>Email Verified : </b> <?= $verified;?> 
                                       
                                        <?php  if($verified == 'Not Verified !'): ?>
                                        <a href="#" id="verify-email" class="float-right">Verify Now </a>
                                        <?php endif; ?> 
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    <?php if(!$cphoto): ?>
                                        <img src="assets/img/ard.jpg" class="img-thumbnail img-fluid" width="408px">
                                        <?php else: ?>
                                        <img src="<?= 'assets/php/'.$cphoto;?>"class="img-thumbnail img-fluid" width="408px">
                                        <?php endif; ?> 
                                </div>
                            </div>
                        </div>
                        <!-- Profile tab content end -->

                        <!-- edit profile tab content start-->
                        <div class="tab-pane container fade" id ="editprofile">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                 <?php if(!$cphoto): ?>
                                        <img src="assets/img/ard.jpg" class="img-thumbnail img-fluid" width="408px">
                                        <?php else: ?>
                                        <img src="<?= 'assets/php/'.$cphoto;?>"class="img-thumbnail img-fluid" width="408px">
                                        <?php endif; ?> 
                                </div>
                                <div class="card border-danger">
                                <form action="" method ="POST" class ="px-3 mt-2" enctype = "multipart/form-data" id ="profile-update-form">
                                    <input type="hidden" name ="oldimage" value="<?= $cphoto; ?>">
                                    <div class="form-group m-0">
                                        <label for="profilephoto" class ="m-1">Upload Profile Picture</label>
                                        <input type="file" name="image" id="profilePhoto" autocomplete="on">
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="profilephoto" class ="m-1">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value = "<?= $cname; ?>" autocomplete="on">
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="profilephoto" class ="m-1">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="" disabled <?php if($cgender == null){
                                                echo'selected';} ?>>Select</option>
                                            <option value="Male"<?php if($cgender == 'Male'){
                                                echo'selected';} ?>>Male</option>
                                            <option value="Female"<?php if($cgender == 'Female'){
                                                echo'selected';} ?>>Female</option>
                                            <option value="Others" <?php if($cgender == 'Others'){
                                                echo'selected';} ?>>Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="dob" class="m-1">Date Of Birth</label>
                                        <input type="date" name="dob" value = "<?= $cdob; ?>" class="form-control" id="dob">
                                    </div>
                                    <div class="form-group m-0">
                                        <label for="phone" class="m-1">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value ="<?= $cphone; ?>" placeholder="Phone" autocomplete="on">
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="submit" name="profile_update" class="btn btn-primary btn-block" id="profileUpdateBtn">
                                    </div> 
                                
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit profile form ends -->

                    <!-- Change Password Tab content starts here -->
                    <div class="tab-pane container fade" id="changePass">
                        <div class="card-deck">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white text-center lead">
                                    Change Password
                                </div>
                                <form action="#" method="POST" class="px-3 mt-2" id="change-pass-form">
                                <div class="form-group">
                                        <p id ="changepassAlert" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="curPass" class="text-danger">Enter Your Current Password*</label>
                                        <input type="password" name="curPass" placeholder="Current Password" class ="form-control form-control-lg" id = "curPass" required minlength="5" autocomplete="on">
                                    </div>
                                    <div class="form-group">
                                        <label for="newPass">Enter New Password*</label>
                                        <input type="password" name="newPass" placeholder="New Password" class ="form-control form-control-lg" id = "newpass" required minlength="5" autocomplete="on">
                                    </div>
                                    <div class="form-group">
                                        <label for="cnewPass">Confirm Password*</label>
                                        <input type="password" name="cnewPass" placeholder="Confirm Password" class ="form-control form-control-lg" id = "cnewpass" required minlength="5" autocomplete="on">
                                    </div>
                                    <div class="form-group">
                                        <p id ="changepassError" class="text-danger"></p>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="submit" name="password_update" class="btn btn-primary btn-block" id="ChangePassBtn">
                                    </div> 
                                </form>
                            </div>

                            <div class="card border-danger align-self-center">
                            <img src="assets/img/Password-Policy.jpg" class ="img-thumbnail img-fluid" width ="408px" >  
                            </div>
                        </div>
                        

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- <h1> <?= basename($_SERVER["PHP_SELF"]); ?></h1> --> 
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/font-awesome/js/all.min.js"></script>
        <script type="text/javascript">
          
            $(document).ready(function(){
                  // Ajax Request
            $("#profile-update-form").submit(function(e){
                    e.preventDefault();

                    $.ajax({
                        url: 'assets/php/process.php',
                        method: 'post',
                        processData: false,
                        contentType:false,
                        cache: false,
                        data: new FormData(this),
                        success: function(response){
                            location.reload();
                        }
                    });
                });
                //change password form ajax request
                $("#ChangePassBtn").click(function(e){
                    if($("#change-pass-form")[0].checkValidity()){
                        e.preventDefault();
                        $("#ChangePassBtn").val("Please Wait");

                        if($("#newpass") .val() != $("#cnewpass").val()){
                            $("#changepassError").text('* Password Mismatched');
                            $("#ChangePassBtn").val("Change Password");
                        }
                        else{
                            $.ajax({
                                url: 'assets/php/process.php',
                                method: 'post',
                                data: $("#change-pass-form").serialize()+'&action=change_pass',  
                                success:function(response){
                                    $("#changepassAlert").html(response);
                                    $("#ChangePassBtn").val("Change Password");
                                    $("#changepassError").text('');
                                    $("#change-pass-form")[0].reset();
                                }
                            });

                        }
                    }
                });

                //verify email ajax
                $("#verify-email").click(function(e){
                    e.preventDefault();
                    $(this).text('Please Wait...');
                    
                    $.ajax({
                        url: assets/php/process.php,
                        method: 'post',
                        data: {action: 'verify_email'},
                        success:function(response){
                            $("#verifyEmailAlert").html(response);
                            $("#verify-email").text('Verify Now')
                        }
                    })
                })
            });
        
            </script>
        </body>
    </html>