<?php
require_once 'admin-db.php';
$admin = new Admin(); 

session_start();

//login ajax request handler
if(isset($_POST['action']) && $_POST['action'] == 'adminLogin'){
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->admin_login($username, $hpassword);

    if ($loggedInAdmin != null) {
        echo 'admin_login';
        $_SESSION['username'] = $username;

    }
    else{
        echo $admin->showMessage('danger', 'Username or Password is wrong*');
    }
}

//fetching user ajax request
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
   $output = '';
   $data = $admin->fetchAllUsers(0);
   $path = '../assets/php/'; //image path

   if ($data){
    $output .= '<table class="table table-bordered text-center table-striped ">
    <thead>
    <tr>
    <th>#</th>
    <th>Image</th>
    <th>Name</th>
    <th>E-mail</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Verified</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>';
    foreach ($data as $row){
        if($row['photo'] != ''){
         $uphoto = $path.$row['photo'];   
        }
        else{
            $uphoto = '../assets/img/ard.jpg';
        }
        $output.='<tr>
                <td>'.$row['id'].'</td>
                <td><img src ="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                <td>'.$row['name'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['gender'].'</td>
                <td>'.$row['verified'].'</td>
                <td> 
                <a href="#" id="'.$row['id'].'" title = "View Details" 
                class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;
                
                <a href="#" id="'.$row['id'].'" title = "Delete" class="text-primary userDeleteIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                </td>
                </tr>';
    }
    $output .= '</tbody>
    </table>';
    echo $output;
   }
   else{
    echo '<h3 class= "text-center text-secondary"> No users Found </h3>';
   }
   
}

    //info details ajax request

    if(isset($_POST['details_id'])){
        $id = $_POST['details_id'];
        $data = $admin->showUserDetails($id);
        echo json_encode($data);
    }

    //Delete users ajax request
    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        $admin->userAction($id, 0);
    }

    //fetching DELETED user ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllDeletedUsers'){
        $output = '';
        $data = $admin->fetchAllUsers(1);
        $path = '../assets/php/'; //image path
    
        if ($data){
        $output .= '<table class="table table-bordered text-center table-striped ">
        <thead>
        <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Verified</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($data as $row){
            if($row['photo'] != ''){
            $uphoto = $path.$row['photo'];   
            }
            else{
                $uphoto = '../assets/img/ard.jpg';
            }
            $output.='<tr>
                    <td>'.$row['id'].'</td>
                    <td><img src ="'.$uphoto.'" class="rounded-circle" width="40px"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td>'.$row['gender'].'</td>
                    <td>'.$row['verified'].'</td>
                    <td> 
                    <a href="#" id="'.$row['id'].'" title = "Restore User" class="text-white restoreUserIcon badge badge-dark p-2">Active</a>
                    </td>
                    </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
        }
        else{
        echo '<h3 class= "text-center text-secondary"> No users Found </h3>';
        }
    }
     //Delete users ajax request
     if(isset($_POST['res_id'])){
        $id = $_POST['res_id'];
        $admin->userAction($id, 1);
    }

    //Fetch all users notes ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes'){
        $output = '';
        $note = $admin->fetchAllNotes();

        if ($note){
        $output .= '<table class="table table-bordered align-self-center text-center table-striped ">
        <thead>
        <tr>
        <th>#</th>
        <th>User Name</th>
        <th>E-mail</th>
        <th>Note Title</th>
        <th>Note</th>
        <th>Written On</th>
        <th>Updated On</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($note as $row){
            $output.='<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['note'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$row['updated_at'].'</td>
                    <td> 
                    <a href="#" id="'.$row['id'].'" title = "Delete Note" class="text-danger deleteNoteIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                    </td>
                    </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
        }
        else{
        echo '<h3 class= "text-center text-secondary"> No Data Found </h3>';
        }
    }

    //delete notes from admin table ajax request
    if(isset($_POST['delete_id'])){
        $admin->deleteNotes($id);
    }

    //Fetch all users notes ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'fetchAllFeedback'){
        $output = '';        
        
        $feedback = $admin->fetchAllFeedback();

        if ($feedback){
        $output .= '<table class="table table-bordered align-self-center text-center table-striped ">
        <thead>
        <tr>
        <th>FID</th>
        <th>UID</th>
        <th>User Name</th>
        <th>User Email</th>
        <th>Subject</th>
        <th>Feedback</th>        
        <th>Written On</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($feedback as $row){

            if($row['replied'] == '1'){
                $replied =  'Replied';   
                }
                else{
                    $replied = 'Not Replied';
                }

            $output.='<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['uid'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['feedback'].'</td>                
                    <td>'.$row['created_at'].'</td>
                    <td>'.$replied.'</td>
                    <td>
                    <a href="#" fid="'.$row['id'].'" id="'.$row['uid'].'" title = "Reply Feedback" class="text-danger replyFeedbackBtn" data-toggle="modal" data-target="#showReplyModal"><i class="fas fa-comment-alt fa-lg"></i></a>&nbsp;&nbsp;

                    <a href="#" id="'.$row['id'].'" title = "Delete Feedback" class="text-danger deleteFeedbackIcon"><i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
                   </td>
                    </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
        }
        else{
        echo '<h3 class= "text-center text-secondary"> No Data Found </h3>';
        }
    }

    //delete feedback from admin table ajax request
    if(isset($_POST['delete_id'])){
        $admin->deleteFeed($id);
    }

    //handle ajax request to reply feedback
    if(isset($_POST['message'])){
       $uid = $_POST['uid'];
       $message = $admin->test_input($_POST['message']);
       $fid = $_POST['fid'];

       $admin->replyFeedback($uid, $message);
       $admin->feedbackReplied($fid);

    }

     //Fetch all users notes ajax request
     if(isset($_POST['action']) && $_POST['action'] == 'fetchAllNotifications'){
        $output = '';
        $notification = $admin->fetchAllNotifications();

        if ($notification){
            foreach ($notification as $row){
                $output .= ' <div class="alert alert-danger" role="alert">
                              <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label ="Close">
                                  <span aria-hidden = "true">&times;</span>
                              </button>
                              <h4 class="alert-heading">New Notification</h4>
                              <p class="mb-0 lead">'.$row['message'].' by '.$row['name'].'</p>
                              <hr class="my-2">
                              <p class="mb-0 float-left">User Email: &nbsp; '.$row['email'].'</p>
                              <p class="mb-0 text-primary float-right">'.$admin->timeInAgo($row['created_at']).'</p>
                              <div class="clearfix"></div>
                              </div>';  
              }
              echo $output;
        }
        else{
        echo '<h3 class= "text-center text-secondary"> No Data Found </h3>';
        }
    }

      //check notification
      if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
        if($admin->fetchAllNotifications()){
            echo '<i class = "fas fa-circle fa-sm text-danger"></i>';
        }
        else {
            echo'';
        }

    }

    //removing notification from database
    if(isset($_POST['notification_id'])){
        $id = $_POST['notification_id'];
        $admin->removeNotification($id);
    }
    //handle export users 
    if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header("Content-type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    $data = $admin->exportAllusers();

    echo '<table border = "1" align-center>';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Joined On</th>
            <th>Verified</th>
            <th>Deleted</th>
        </tr>';
        foreach ($data as $row){
            echo '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['dob'].'</td>
            <td>'.$row['created_at'].'</td>
            <td>'.$row['verified'].'</td>
            <td>'.$row['deleted'].'</td>
            </tr>';
        }
         echo '</table>';

    }
   
   
?>