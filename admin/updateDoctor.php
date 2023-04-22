<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['phone'])&&isset($_POST['id'])&&isset($_POST['gender']))
{
		$id=$_POST['id'];
		$newName=$_POST['name'];
		$newUsername=$_POST['username'];
		$newEmail=$_POST['email'];
		$newPhone=$_POST['phone'];
		$newRoleId=$_POST['role'];
		$newGender=$_POST['gender'];
		$newSchedule=$_POST['schedule'];
		$newImage=$_FILES['image'];
		$_SESSION['error']="";
		$_SESSION['success']="";

			if(Validator::emptyfields($newName,$newEmail,$newRoleId,$newGender))
			{
			            $_SESSION['error']='<p style="color:red">name,role,email,gender cannot be empty</p>';
			            header('Location:editDoctor.php');
			            exit();
			}
			$doctor=new Doctor();
			$role=new Role();
			$scheduler=new Scheduler();
			
			if($doctor->setUserById($id)!==false)
					{
						$authenticator=new Authenticator($doctor);
						$oldName=$doctor->getName();
						$oldPhone=$doctor->getPhone();
						$oldUsername=$doctor->getUsername();
						$oldGender=$doctor->getGender();
						$oldEmail=$doctor->getEmail();
						$oldProfileImage=$doctor->getProfileImage();
						$oldRoleAr=$role->getMatchingRole($id);
						if($oldRoleAr!==false)
						{
							$oldRole=$oldRoleAr['roleId'];
						}else{
							$oldRole="";
						}
						$oldSchedule=$scheduler->getSchedule($id)!==false?$scheduler->getSchedule($id):"";

						if($newName!==$oldName)
						{
							if(Validator::invalidName($newName))
							{
								$_SESSION['error'].='<p style="color:red">name cannot contain special characters</p>';
							}else{
								if($doctor->updateName($newName)!==false)
								{
									$_SESSION['success'].='<p style="color:#ffa500">name updated successfully</p>';
								}else{
									$_SESSION['error'].='<p style="color:red">Could not update name</p>';
								}
							}
						}
						if($newGender!==$oldGender)
						{
								if($doctor->updateGender($newGender)!==false)
								{
									$_SESSION['success'].='<p style="color:#ffa500">Gender updated successfully</p>';
								}else{
									$_SESSION['error'].='<p style="color:red">Could not update gender</p>';
								}
						}
						if($newUsername!==$oldUsername)
						{
							if(Validator::invalidUsername($newUsername))
							{
								$_SESSION['error'].='<p style="color:red">Username should start with a letter and be alphanumerical without space</p>';
							}else{


								if($authenticator->usernameExist($newUsername)!==false)
				            	{
				              $_SESSION['error'].='<p style="color:red">Username already exist</p>';
				            	}else{
					                if($doctor->updateUsername($newUsername)===false)
					                {
					                  $_SESSION['error'].='<p style="color:red">Could not update Username</p>';
					                }
					                else{
					                  $_SESSION['success'].='<p style="color:#ffa500">username updated successfully</p>';
					                }
				            		}  
				         		 }
							}

							if($newEmail!==$oldEmail)
							{
				            $email=Validator::isvalidMail($newEmail);
				            if($email===false)
				            {
				            	$_SESSION['error'].='<p style="color:red">Enter valid Email</p>';
				            }
				            else{
				              if($authenticator->emailExist($newEmail))
				              {
				                $_SESSION['error'].='<p style="color:red">Email already exist</p>';
				              }else{
				              	if($doctor->updateEmail($newEmail)===false)
					                {
					                  $_SESSION['error'].='<p style="color:red">Could not update Email</p>';
					                }
					                else{
					                 $mailer=new Mailer();
				                	$receiver=$newEmail;
				                	$subject='Email change';
				               		 $body='We have granted your request for changing Email address. From now on you will be using this email address to log in with Docare.';
				                 	$mailer=$mailer->sendMail($receiver,$subject,$body);
				                 	$_SESSION['success']='<p style="color:green">Email updated successfully</p>';
					                }
				              	}
				            }   
						}

						if($newPhone!==$oldPhone)
						{
							$phone=Validator::isvalidPhonenumber($newPhone);
				            if($phone===false)
				            {
				              $_SESSION['error'].='<p style="color:red">Enter a valid phone number</p>';
				            }else{
				            	if($doctor->updatePhone($newPhone)===false)
					                {
					                  $_SESSION['error'].='<p style="color:red">Could not update Phone</p>';
					                }
					                else{
					                  $_SESSION['success'].='<p style="color:#ffa500">Phone updated successfully</p>';
					                }
				            }
						}
						if($newRoleId!=="NULL")
						{	
							if($oldRole==="")
							{
								   if($role->setDoctorRole($id,$newRoleId)!==false)
                    				{
                      				 $_SESSION['success'].='<p style="color:#ffa500">	Role assigned successfully</p>';
                    				}else{
                      					$_SESSION['error'].='<p style="color:red">Could not assign role</p>';
                    				}
							}elseif($newRoleId!==$oldRole)
									{
									if($role->updateRole($id,$newRoleId)===false)
									{
										$_SESSION['error'].='<p style="color:red">Could not update role</p>';
									}
									else{
									  $_SESSION['success'].='<p style="color:#ffa500">Role updated successfully</p>';
										}
									}
						}
						if($newSchedule!=="NULL")
						{
							if($oldSchedule==="")
							{
								if($scheduler->setDoctorSchedule($id,$newSchedule)!==false)
                    				{
                    					$_SESSION['success'].='<p style="color:#ffa500">Schedule assigned successfully</p>';
                      
                    				}
                    				else{
                     					$_SESSION['error'].='<p style="color:red">Could not assign schedule</p>';
                    					}
							}
							elseif($newSchedule!==$oldSchedule)
							{
								if($scheduler->updateSchedule($id,$newSchedule)!==false)
								{
									 $_SESSION['success'].='<p style="color:#ffa500">Schedule updated successfully</p>';
								}else
								{
									$_SESSION['error'].='<p style="color:red">Could not update Schedule</p>';
								}


							}
						}
						if (!Validator::isEmptyfile($newImage)) 
				        {
				          if(Validator::invalidImageSize($newImage))
				          {
				            $_SESSION['error'].='<p style="color:red">file size cannot be over 5MB</p>';
				     
				          }else{
				              if(Validator::fileUploadError($newImage))
				              {
				                $_SESSION['error'].='<p style="color:red">There was an error while uploading file</p>';
				              }else{
				                  if(Validator::invalidImageFormat($newImage))
				                    {
				                  $_SESSION['error'].='<p style="color:red">Image should be of format jpg,png,jpeg only</p>';
				                  }else{
				                      if($doctor->updateProfileImage($newImage)===false)
				                        {
				                         $_SESSION['error'].='<p color="red">Could not update profil Image</p>';
				                        }
				                      else
				                        {
				                           $_SESSION['success'].='<p style="color:#ffa500>Profile Image has been updated</p>';
				                        }
				                  }
				                }
				            }
				         }
				         header('Location:editDoctor.php?id='.$id);
				         exit();    
					}
			else{
				$_SESSION['error']='<p style="color:red">Incorrect user Id</p>';
			    header('Location:editDoctor.php');
			    exit();
			}
}else{
	die('Access Denied');
}

 ?>