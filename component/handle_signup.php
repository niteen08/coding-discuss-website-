 
<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'dbconnect.php';
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    // Check whether this email exists
    $existSql = "select * from `users` where username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){

        $showError='username already exist !';
        header("Location: /discuss/index.php?error=$showError");
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `user_pass`, `user_date`) VALUES ( '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                header("Location: /discuss/index.php?signupsuccess=true");
                exit();
            }

        }
        else{

            $showError='Password do not match !';
            header("Location: /discuss/index.php?error=$showError");
            
        }
        header("Location: /discuss/index.php?error=$showError");
    }

}
?>