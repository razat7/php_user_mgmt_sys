<?php
require_once 'session.php';

//handle add new note ajax request
if(isset($_POST['action']) && $_POST['action'] == 'add_note'){
$title = $cuser->test_input($_POST['title']);
$note = $cuser->test_input($_POST['note']);

$cuser->add_new_note($cid, $title, $note);
$cuser->notification($cid, 'admin','New Note Added' );
}


//handle dispaly all notes of an user 
if(isset($_POST['action']) && $_POST['action']== 'display_notes'){
    $output = '';

    $notes =  $cuser->display_data($cid);
    if($notes){
        $output .='<table class="table table-striped text-center">
        <thead>
            <tr class="text-center">
                <th>S.N</th>
                <th>Title</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($notes as $row){
            $output .=' <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.substr($row['note'],0,75).'...</td>
            <td>
                <a href="#" id ="'.$row['id'].'" title="view-details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"> </i> </a>
                <a href="#" id ="'.$row['id'].'" title="edit-details" class="text-primary editBtn" data-toggle="modal" data-target="#editNoteModal"><i class="fas fa-edit fa-lg"> </i> </a>
                <a href="#" id ="'.$row['id'].'" title="delete-details" class="text-danger deleteBtn"><i class="fas fa-trash-alt fa-lg"> </i> </a>
            </td>
        </tr>';
        }
        $output .= '</tbody> </table>';
        echo $output;
    }
    else {
        echo '<h3 classs ="text-center text-danger"> :(No Notes Found ! </h3>';
    }
}

    //handle edit note ajax request
    if(isset($_POST['edit_id'])){
        $id = $_POST['edit_id'];
        $row = $cuser->edit_note($id);
        echo json_encode($row);
    }

    //handle update note ajax request
    if(isset($_POST['action']) && $_POST['action']== 'update_note'){
        
        $id = $cuser->test_input($_POST['id']); 
        $title = $cuser->test_input($_POST['title']);
        $note = $cuser->test_input($_POST['note']);
      
        $cuser->update_note($id, $title, $note);
        $cuser->notification($cid, 'admin','Note Updated' );

    }

    //delete note ajax request 
    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        
        $del = $cuser->delete_note($id);
        $cuser->notification($cid, 'admin','Note Deleted' );
    }

    // details note ajax request
    if(isset($_POST['info_id'])){
        $id = $_POST['info_id'];
        $row = $cuser->edit_note($id);
        echo json_encode($row);
    }
    
    //handeling editprofile ajax request
    if(isset($_FILES['image'])){ //fetching file types
     $name = $cuser->test_input($_POST['name']);
     $gender = $cuser->test_input($_POST['gender']);
     $dob = $cuser->test_input($_POST['dob']);
     $phone = $cuser->test_input($_POST['phone']);

     $oldImage = $_POST['oldimage'];
     $folder = 'uploads/';

     if(isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
        $newImage = $folder.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

        if($oldImage != null) {
            unlink($oldImage); // to delete old image
        }
     }
     else {
        $newImage = $oldImage;
     }
    $cuser->update_profile($name, $gender, $dob, $phone, $newImage, $cid);
    $cuser->notification($cid, 'admin','Profile Edited' );
    }

    //handeling ajax request to change password from profile.php
    if(isset($_POST['action']) && $_POST['action']== 'change_pass'){
        // print_r($_POST);
        $currentPass = $_POST['curPass']; // session current password
        $newPass = $_POST['newPass']; //session new password
        $cnewPass = $_POST['cnewPass']; //session confirm password

        $hnewPass = password_hash($newPass, PASSWORD_DEFAULT); //hashing the newpassword

        if($newPass != $cnewPass){ //comparing the new password with confirm new password
            echo $cuser->showMessage('danger', 'Password did not match !');
        }
        else {
            if (password_verify($currentPass, $cpass)){ //fetching cpass to check the current password
                $cuser->change_password($hnewPass, $cid); //executing the public function created at auth.php
                $cuser->notification($cid, 'admin','Password Changed' );
                echo $cuser->showMessage('danger', 'Password Changed Successfully');
            }
            else{
                echo $cuser->showMessage('danger', 'Current Password is Wrong');
            }
        }

    }

    //Handle verify email in profile.php ajax request

    // if(isset($_POST['action']) && $_POST['action']== 'verify_email'){

    // }

    //Handle users feedback ajax request

    if(isset($_POST['action']) && $_POST['action'] == 'feedback'){
        $subject = $cuser->test_input($_POST['subject']);
        $feedback = $cuser->test_input($_POST['feedback']);

        $cuser->feedback_submit($cid, $subject, $feedback);
        $cuser->notification($cid, 'admin','Feedback Received' );
    }

    //fetch notification ajax request
    if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
        $notification = $cuser->fetchNotification($cid); 
        $output = ''; 
        if($notification){
            foreach ($notification as $row){
              $output .= ' <div class="alert alert-danger" role="alert">
                            <button type="button" id="'.$row['id'].'" class="close" data-dismiss="alert" aria-label ="Close">
                                <span aria-hidden = "true">&times;</span>
                            </button>
                            <h4 class="alert-heading">New Notification</h4>
                            <p class="mb-0 lead">'.$row['message'].'</p>
                            <hr class="my-2">
                            <p class="mb-0 float-left">Reply of Feedback From Admin: &nbsp;</p>
                            <p class="mb-0 text-primary float-left">'.$cuser->timeInAgo($row['created_at']).'</p>
                            <div class="clearfix"></div>
                            </div>';  
            }
            echo $output;
        }
        else{
            echo '<h3 class="text-center text-secondary mt-5"> No New Notification </h3>';
        }
    }



        //check notification
        if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
            if($cuser->fetchNotification($cid)){
                echo '<i class = "fas fa-circle fa-sm text-danger"></i>';
            }
            else {
                echo'';
            }

        }
        //remving notification from database
         if(isset($_POST['notification_id'])){
            $id = $_POST['notification_id'];
            $cuser->removeNotification($id);
         }
    
    ?>