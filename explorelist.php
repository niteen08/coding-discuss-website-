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
     #question
     {
        margin-bottom:2rem;
     }
    </style>
    <title>Welcome to I-Discuss</title>
</head>

<body>
    <?php include 'component/dbconnect.php';?>
    <?php include 'header.php';?>
    

    <?php
    

     $id = $_GET['catid'];
     $sql = "SELECT * FROM `category` WHERE category_id=$id";
     $result =mysqli_query($conn, $sql);

    //fetch the category help of loop
     while($row = mysqli_fetch_assoc($result))
     {
        $catname = $row['category_name']; 
        $catdesc = $row['category_desc']; 
      
     }
     ?>
    <?php
      
     $showAlert = false;
     $method = $_SERVER['REQUEST_METHOD'];
      if($method=='POST')
      {
        //insert into database
        
     /*   $ques_title = $_POST['title'];
        $ques_desc = $_POST['desc'];

        $user_id = $_POST['user_id'];
       // $sql = "INSERT INTO `explore` (`explore_title`, `explore_desc`, `explore_cat_id`, `explore_user_id`, `date`) 
       // VALUES ('$ques_title', '$ques_desc', '$id', '$user_id', current_timestamp())";
       // $result = mysqli_query($conn,$sql);
         $sql = "INSERT INTO `explore`(`explore_title`, `explore_desc`, `explore_cat_id`, `explore_user_id`, `date`)
         VALUES ( '$ques_title', '$ques_desc', '$id', '$user_id', current_timestamp());";
         $result = mysqli_query($conn, $sql);*/
          $sql = "INSERT INTO `explore` (`explore_title`, `explore_desc`, `explore_cat_id`, `explore_user_id`, `date`)
          VALUES (?, ?, ?, ?, current_timestamp())";
 
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("ssss", $ques_title, $ques_desc, $id, $user_id);
 
        // Set your parameter values
            $ques_title = $_POST['title'];
            $ques_desc = $_POST['desc'];
            
        $ques_title = str_replace("<", "&lt;", $ques_title);
        $ques_title = str_replace(">", "&gt;", $ques_title); 

        $ques_desc = str_replace("<", "&lt;", $ques_desc);
        $ques_desc = str_replace(">", "&gt;", $ques_desc); 
            $user_id = $_POST['user_id'];
 
                // Execute the statement
                     $stmt->execute();
 
                // Close the statement
                   $stmt->close();
 

         
         $showAlert = true;
        if($showAlert){
            
            
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your Question has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        } 

      }
     ?>

    <div class="container my-4">
    

        <div class="jumbotron" id="content">
            <h1 class="display-4"> welcome to <?php echo $catname ?></h1>
            <p class="lead"> <?php echo $catdesc ;?></p>
            <hr class="my-4">
            <h5> rule of Forum</h5>
            <p> Remain respectful of other members at all times.<br>Share your knowledge. Don't hold back in sharing
                your knowledge – it's likely someone will find it useful or interesting. When you give information,
                provide your sources.<br>Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
            <a class="btn btn-primary btn-lg" href="https://www.w3schools.com/java/" role="button">Learn more</a>
        </div>

    </div>
   
    


    <div class="container my-3">
        <h1> Start the Conversation</h1>
        <?php
  //echo $_SESSION["user_id"];
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    echo'

        <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">
            <div class="mb-3 w-50">
            <input type="hidden" name="user_id" value="'. $_SESSION["user_id"]. '">
                <label for="title" class="form-label">Question Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            
            <div class="mb-3 w-50">
                <label for="description" class="form-label">Question Description</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>';
    

}
else{
    
    echo' <div class="lead">
    <p> You Are Not logged in. Please login to be able to start Conversation.</p>
    </div>'; 
    
 
    }
?>
   </div> 
  
    <div class="container " id="question">
        <h1>Browse Question</h1>

        <?php
     $id = $_GET['catid'];
     $sql = "SELECT * FROM `explore` WHERE explore_cat_id=$id; ";
     $result =mysqli_query($conn, $sql);

    //fetch the category help of loop
    $noresult = true;
     while($row = mysqli_fetch_assoc($result))
     {
        $noresult = false;
        $id = $row['explore_id'];
        $title = $row['explore_title']; 
        $desc = $row['explore_desc']; 
        $explore_time = $row['date'];
        $explore_user_id = $row['explore_user_id'];
        $sql2 = "SELECT username FROM `users` WHERE user_id='$explore_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);



        echo'
        <div class="media my-4">
            <img src="img/user-1.png" width="70px" class="mr-2" alt="...">
            <div class="media-body">
            <i class="fst-italic">Asked by </i>
            <p class="fw-bold d-inline-flex mr-2 mb-0">'.$row2['username'].' </p>
                <h5 class="m-0 "><a class="text-dark text-decoration-none my-0 ml-3 " href="explore.php?exploreid='.$id.'">'.$title.'</a></h5>
                <p class="ml-3 mb-0">'.$desc.' </p>
                

            <a  class="text-dark mb-0" href="explore.php?exploreid='.$id.'">Answer</a>
            </div>
         
        </div>';
  }
   if($noresult)
       {
             echo'<div class="jumbotron jumbotron-fluid p-0">
             <div class="container">
               <p class="display-6 text-center">No question Found...!</p>
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