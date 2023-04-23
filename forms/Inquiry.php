<?php
        $eerr = $sterr =$message= '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $your_name = $_REQUEST["name"];
            $email_id = $_REQUEST["mail"];
 

            if (!preg_match('/^[a-zA-Z]*$/', $your_name)) {
                $sterr = 'invalid student name';
            }
            if (!preg_match('/^[a-zA-Z0-9@.]*$/', $email_id)) {
                $eerr = 'invalid email id';
            } else {
                $connect = mysqli_connect("localhost", "root", "root", "portfoilo")or die('connection failed');
                $query = mysqli_query($connect,"select email_id from inquiry where Email='".$email_id."'")or die('table connection failed');

                if ($row = mysqli_fetch_array($query)) {
                    $eerr = 'email_id already exist';
                }
            }
            
            if ($sterr=="" && $eerr=="") {
                $your_name = $_REQUEST["name"];
                $email_id = $_REQUEST["mail"];
                $subject = $_REQUEST["sub"];
                $massage = $_REQUEST["msg"];
               // printf($student_name);
               // die;

                $connect = mysqli_connect("localhost", "root", "root", "portfoilo")or die('connection failed');
                $query = mysqli_query($connect,"select MAX(Id) as Id from inquiry")or die("table connection failed");
                $Id = 1;
                if ($row = mysqli_fetch_array($query)) {
                    $Id = $row['Id'];
                }
                $Id++;
                $query = mysqli_query($connect,"INSERT INTO `inquiry` (`Id`, `Name`, `Email`, `Subject`, `Message`) VALUES('".$your_Id."','".$your_name."','".$email_id."','".$subject."','".$massage."')")or die("query failed");
                $message='Registered';
            }
        }
        ?>