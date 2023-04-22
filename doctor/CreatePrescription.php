<?php 
session_start();
if(!isset($_SESSION['doctorId'])&&empty($_SESSION['doctorId']))
{
    die('ACCESS DENIED');
}
include_once "../includes/autoloader.include.php";
if(isset($_GET['bid']))
{
    $bid=$_GET['bid'];
    $pa=new Patient();
    $bo=new Booking();
    $ap=new Appointment();
    if($bo->setBookingById($bid)===false)
    {
        header('Location:appointment.php');
        exit();
    }
    $apId=$bo->getAppointmentId();

    $ap->setAppointmentById($apId);
    $pid=$ap->getPId();
    $pa->setUserById($pid);
    $name=$pa->getName();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Create Prescription</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <?php 
        include "header.php";
        ?>
        <div class="container pt-5">
        <?php

      if(isset($_SESSION['error']))
      {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
      }

      ?>
       <h1>Create Prescription</h1>
      <p>*File upoads cannot exceed 8MB</p>
            <h3 class="mb-4">USER NAME : <?php echo $name;?></h3>
    <form action="saveprescription.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="ap_id" value="<?php echo $apId;?>">
        <input type="hidden" name="bid" value="<?php echo $bid;?>">
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" value="<? echo $name; ?>" name="patient_name"><label>Patient Name : </label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="patient_age"><label>Age </label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="patient_weight"><label>Weight(KG)</label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="bp"><label>Blood Pressure</label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="hr"><label>Heart Rate(BPM)</label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="temp"><label>Temperature(F)</label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="rr"><label>Respiratory Rate(BPM)</label></div>
       <div class="floating-label"><input placeholder=" " class="floating-input" type="text" name="spo2"><label>SpO2(%)</label></div>
       <div ><alabel>Remarks : </alabel><textarea placeholder=" " name="remarks"></textarea></div>
       <div><div class="file-upload">
       
  <div class="file-select">
<!--     <alabel>Upload Prescription</alabel>-->
    <div class="file-select-button" id="fileName">Upload Prescription</div>

    <div class="file-select-name" id="noFile">No file chosen...</div> 

    <input type="file" name="prescriptionFile" id="chooseFile" class="chooseFile">

  </div>

</div></div>
       <div class="mb-3 mt-3"><input class="btn btn-success" type="submit" name="submit"></div>
    </form>
            </div>
    <!--<button id="add">Upload more file</button>-->
    </body>
        <script>$('#chooseFile').bind('change', function () {

  var filename = $("#chooseFile").val();

  if (/^\s*$/.test(filename)) {

    $(".file-upload").removeClass('active');

    $("#noFile").text("No file chosen..."); 

  }

  else {

    $(".file-upload").addClass('active');

    $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 

  }

});

</script>
    <!--<script>
      $('#add').click(function(){
        var newFileInput=$('<input type="file" name="prescriptionFile[]"></input>');
        newFileInput.insertBefore('input[name="submit"]');
      });
    </script>-->
    </html>
    <?php
}else{
    header('Location:appointment.php');
    exit();
}