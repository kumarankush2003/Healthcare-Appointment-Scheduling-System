<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: appointment.php");
         
        }

    }else{
        header("location: ../login.php");
    }
    // require 'cancel_send.php';
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from appointment where appoid='$id';");
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        // require 'cancel_send.php';
        
    }
?>