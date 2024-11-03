<?php
       $showError = false;
       if($_SERVER["REQUEST_METHOD"] == "POST")
         {
              include 'dbconnect.php';
              $username  = $_POST['username'];
              $pass = $_POST['password'];  
              
              $sql = "select * from users where username='$username'";
              $result =  mysqli_query( $conn, $sql);
              $numRows = mysqli_num_rows($result);
              if($numRows==1)
              {
                      $row = mysqli_fetch_assoc($result);
                     
                      if(password_verify($pass, $row['user_pass']))
                      {
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $username;
                         
                        
                        header("location:/discuss/index.php?loginsuccess=true");
                        
                      
                      } 
                      $showError = "Invalid Credentials";
                       
              }
              $showError = "Invalid Credentials";
               
        }
  //       if($showError)
  // {
  //   echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                  //             <strong>failed!</strong> '.$showError
  //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //               <span aria-hidden="true">&times;</span>
  //             </button>
  //         </div>';
  //}
?>
