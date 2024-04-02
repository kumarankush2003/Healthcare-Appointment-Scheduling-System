<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Sessions</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
<?php
session_start();

// Check if the user is logged in and is a patient
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'p') {
    header("location: ../login.php");
    exit;
}

$useremail = $_SESSION["user"];

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'cse21012@iiitkalyani.ac.in'; // Your Gmail address
    $mail->Password   = 'vweboznlveghlaxs'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('cse21012@iiitkalyani.ac.in', 'Your Name'); // Your email address and name
    $mail->addAddress($useremail); // Recipient's email address
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Confirmation';
        $mail->Body    = "Dear patient, your appointment has been cancelled.";
        // Send email
        $mail->send();
    
        echo '
        <div id="popup1" class="overlay">
           <div class="popup">
               <center>
                   <h2></h2>
                   <a class="close" href="doctors.php">&times;</a>
                   <div class="content">
                       Web App<br>
                       "Appointment confirmation sent to the patient.";
                   </div>
               </center>
               <br><br>
           </div>
        </div>';
        exit;
    }  
    catch (Exception $e){
        echo ' <div id="popup1" class="overlay">
        <div class="popup">
            <center>
                <h2></h2>
                <a class="close" href="doctors.php">&times;</a>
                <div class="content">
                    Web App<br>
                    "Failed to send appointment confirmation. Error: Email not found";
                </div>
            </center>
            <br><br>
        </div>
     </div>';
     exit;
    }
    header("location: appointment.php");
?> 