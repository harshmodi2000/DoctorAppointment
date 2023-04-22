<?php 
session_start();
if(!isset($_SESSION['doctorId'])&&empty($_SESSION['doctorId']))
{
    die('ACCESS DENIED');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['submit'])&&isset($_POST['ap_id'])&&isset($_POST['patient_name'])&&isset($_POST['patient_age'])&&isset($_POST['patient_weight'])&&isset($_POST['bp'])&&isset($_POST['hr'])&&isset($_POST['temp'])&&isset($_POST['rr'])&&isset($_POST['spo2'])&&isset($_POST['remarks'])&&isset($_FILES['prescriptionFile']))
{
	$bid=$_POST['bid'];
	$apId=$_POST['ap_id'];
	$pName=$_POST['patient_name'];
	$pAge=$_POST['patient_age'];
	$pWeight=$_POST['patient_weight'];
	$bp=$_POST['bp'];
	$hr=$_POST['hr'];
	$temp=$_POST['temp'];
	$rr=$_POST['rr'];
	$spo2=$_POST['spo2'];
	$remarks=$_POST['remarks'];
	$error='';
	if(count($_FILES['prescriptionFile'])<1||empty($_FILES['prescriptionFile']))
	{
		$error.='<p style="color:orange">Please add a prescription file</p>';
    $_SESSION['error']=$error;
            header('Location:createprescription.php?bid='.$bid);
                   exit();
	}
	if(empty($apId)||!is_numeric($apId))
	{
		header('Location:createprescription.php?bid='.$bid.'&&error=missingAppointmentId');
		exit();
	}
	$presc=new Prescription();
	$id=$presc->addPrescription($apId,$pName,$pAge,$pWeight,$bp,$hr,$temp,$rr,$spo2,$remarks);
	$presc->setPrescriptionById($id);
	if($id!==false)
	{

		if(Validator::isEmptyfile($_FILES['prescriptionFile']))
          {
            $presc->deleteApId($apId);
            $error.='<p style="color:orange">Please add file to the prescription</p>';
            $_SESSION['error']=$error;
            header('Location:createprescription.php?bid='.$bid);
                   exit();
          }

          if(Validator::invalidFileSize($_FILES['prescriptionFile']))
          {
            $presc->deleteApId($apId);
            $error.='<p style="color:orange">One of the prescription file exceeds 8MB in size</p>';
            $_SESSION['error']=$error;
            header('Location:createprescription.php?bid='.$bid);
                   exit();

          }else{
              if(Validator::fileUploadError($_FILES['prescriptionFile']))
              {
                $presc->deleteApId($apId);
                $error.='<p style="color:orange">There was an error while uploading file</p>';
                $_SESSION['error']=$error;
                header('Location:createprescription.php?bid='.$bid);
                   exit();
              }else{
              	$fname=$presc->uploadPrescriptionFile($_FILES['prescriptionFile']);

                      if(strlen($fname)<1)
                        {
                         $error.='<p style="color:orange">Could not upload file</p>';
                         $_SESSION['error']=$error;
                         $presc->deleteApId($apId);
                         header('Location:createprescription.php?bid='.$bid);
                          exit();
                        }
                      else
                        {
                           $filenames=$fname;
                        }
                  	}
                }
                if(strlen($error)>1)
                {
                	$presc->deleteApId($apId);
                	$_SESSION['error']=$error;
                	header('Location:createprescription.php?bid='.$bid.'&&error=filesizeExceedingLimits');
					       exit();
            	}
            	if($presc->updatePrescriptionFile($filenames))
            	{
            		$b=new Booking();
            		if($b->updateBookingStatus($bid,'attended'))
            		{
                  $role=new Role();
                  $mailer=new Mailer();
                  $b->setBookingById($bid);
                  $appointment=new Appointment();
                  $appointment->setAppointmentById($b->getAppointmentId());
                  $patient=new Patient();
                  $patient->setUserById($appointment->getPId());
                  $doctor=new Doctor();
                  $doctor->setUserById($appointment->getDId());
                  $receiver=$patient->getEmail();
                  $subject='Appointment Report';
                    $body="Dear <b>".$patient->getName().',</b>';
                    $body.="<p>This is the report of your appointment with <b>Dr ".$doctor->getName()."</b> (".ucwords($role->getUserRole($doctor->getId())).") on <b>".$appointment->getApDate()."</b> at <b>".$appointment->getApTime()."</b>.</p>";
                    $body.="<table>";
                    $body.="<tr><td>Patient Name: </td><td>".$presc->getPatientName()."</td></tr>";
                    $body.="<tr><td>Patient Age: </td><td>".$presc->getPatientAge()."</td></tr>";
                    $body.="<tr><td>Patient Weight: </td><td>".$presc->getPatientWeight()."</td></tr>";
                    $body.="<tr><td>Patient Blood Pressure: </td><td>".$presc->getPatientBloodPressure()."</td></tr>";
                    $body.="<tr><td>Patient Heart Rate: </td><td>".$presc->getPatientHeartRate()."</td></tr>";
                    $body.="<tr><td>Patient Temperature: </td><td>".$presc->getPatientTemperature()."</td></tr>";
                    $body.="<tr><td>Patient Respiratory rate: </td><td>".$presc->getPatientRespiratoryRate()."</td></tr>";
                    $body.="<tr><td>Patient Oxygen Level(SpO2): </td><td>".$presc->getPatientOxygenLevel()."</td></tr>";
                    $body.="<tr><td>Remarks from de Doctor: </td><td>".$presc->getRemarksFromDoctor()."</td></tr>";
                    $body.="</table>";
                    $body.='<p><b>Your prescription file has been attached below</b></p>';
                    $body.='<p>Thank you for trusting Docare.<p>';
                    $mailer=$mailer->sendMail($receiver,$subject,$body,$presc->getPrescriptionFileLink($filenames));
            			header('Location:appointment.php');
            			exit();
            		}
            	}else{
            		  $presc->deleteApId($apId);
                	$_SESSION['error']=$error;
                	header('Location:createprescription.php?bid='.$bid.'&&error=CouldnotCreatePrescription');
						      exit();
            	}
	 }
}
else{
	header('Location:createprescription.php?bid='.$bid.'&&error=unauthorized');
	exit();
}