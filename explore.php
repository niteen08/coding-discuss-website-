<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
    #ques {
        min-height: 433px;
    }

    #comments {
        margin-bottom: 2rem;
    }
    </style>
    <title>Welcome to I-Discuss</title>
</head>

<body>
    <?php include 'component/dbconnect.php';?>
    <?php include 'header.php';?>
    
    
    <?php
 $id = $_GET['exploreid'];
 $sql = "SELECT * FROM `explore` WHERE explore_id=$id; ";
 $result =mysqli_query($conn, $sql);

//fetch the category help of loop
  
 while($row = mysqli_fetch_assoc($result))
 {
     
    $id = $row['explore_id'];
    $title = $row['explore_title']; 
    $desc = $row['explore_desc']; 
    $explore_user_id = $row['explore_user_id'];
     $sql2 = "SELECT username FROM `users` WHERE user_id='$explore_user_id'";
     $result2 = mysqli_query($conn,$sql2);
     $row2 = mysqli_fetch_assoc($result2);
      $posted_by = $row2['username'];
 
    echo'
    <div class="container my-4 ">
        <div class="jumbotron" id="content">
            <h1 class="display-4"> '.$title.' </h1>
            <p class="lead"> '.$desc.' </p>
            <hr class="my-4">
            <h5> rule of Forum</h5>
            <p> Remain respectful of other members at all times.<br>Share your knowledge. Dont hold back in sharing
                your knowledge – it s likely someone will find it useful or interesting. When you give information,
                provide your sources.<br>Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
               <p>Posted by : <b>'.$posted_by.'</b></p>
        </div>

    </div>';
}
?>
    <?php
     
      $showAlert = false;
      $method = $_SERVER['REQUEST_METHOD'];
       if($method=='POST')
       {
         //insert into database
 
        /* $comments = $_POST['comment'];
         $comments = str_replace("<", "&lt;", $comments);
         $commens = str_replace(">", "&gt;", $comments); 
         $user_id = $_POST['user_id'];
        $sql = "INSERT INTO `comments` (`comment_text`, `explore_id`, `comment_by`, `comment_time`) 
         VALUES ('$comments', '$id', '$user_id', current_timestamp());";
         $result = mysqli_query($conn, $sql);*/

        $sql = "INSERT INTO `comments` (`comment_text`, `explore_id`, `comment_by`, `comment_time`)
        VALUES (?, ?, ?, current_timestamp())";

              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sss", $comment_text,$id,$user_id);

               // Set your parameter values
                      $comment_text = $_POST['comment']; 

                      //replace tagline 
                      $comment_text = str_replace("<", "&lt;", $comment_text);
                      $comment_text = str_replace(">", "&gt;", $comment_text); 
                      $user_id = $_POST['user_id'];

               // Execute the statement
                       $stmt->execute();

                      // Close the statement
                          $stmt->close();

        
          $showAlert = true;
          if($showAlert){
             
             
             echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>Success!</strong> Your comment has been added!  
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                   </div>';
                   
                   
                         } 
 
       }
      ?>
    <div class="container my-3">
        <h1>Post a Comments</h1>
        <?php

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    echo'
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">

            <div class="mb-3 w-50">
            <input type="hidden" name="user_id" value="'. $_SESSION["user_id"]. '">
                <label for="description" class="form-label">Type the comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
   ';
}
else{
    echo'  <div class="lead">
           <p> You Are Not logged in. Please login to be able to post comments.</p>
           </div>';
    
     }
     ?>
      </div>
    <div class="container" id="comments">
        <h1 class="py-2">Discussions</h1>
        <?php
     $id = $_GET['exploreid'];
     $sql = "SELECT * FROM `comments` WHERE explore_id=$id; ";
     $result =mysqli_query($conn, $sql);

    //fetch the category help of loop
    $noresult = true;
     while($row = mysqli_fetch_assoc($result))
     {
        $noresult = false;
        $id = $row['comment_id'];
        $text = $row['comment_text']; 
        $time = $row['comment_time']; 
        $comment_by = $row['comment_by'];
        $sql2 = "SELECT username FROM `users` WHERE user_id='$comment_by'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        
    
        echo'
        <div class="media mb-3">
            <img src="img/user-1.png" width="70px" class="" alt="...">
            <div class="media-body ">
            <p class="fw-bold d-inline-flex mr-2 mb-0">'.$row2['username'].'</p><i class="fst-italic">At-'.$time.'</i>
                <p>'.$text.' </p>

            </div>
         
        </div>';
  }
   if($noresult)
       {
             echo'<div class="jumbotron jumbotron-fluid p-0">
             <div class="container">
               <p class="display-6 text-center">No Comments Found...!</p>
               <p class="lead text-center">Be The First Person Type The Question..</p>
             </div>
           </div>';
      }
  ?>
    </div>



    <?php include 'footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>