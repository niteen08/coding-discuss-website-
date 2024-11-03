
<?php
$showError=false;

session_start();

echo'
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <a class="navbar-brand" href="/discuss"   height="28px" alt=""> I-Discuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <li class="nav-item active"></li>
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown"> ';
         
        $sql = "SELECT `category_name`,`category_id` FROM `category` LIMIT 5";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
          echo'<a class="dropdown-item" href="explorelist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
        }
            

       echo' </div>
      </li>

        <li class="nav-item">
          <a class="nav-link" href="contactus.php">Contact Us</a>
        </li>
           
        <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
      
      </ul>
      <div class="row mx-2">';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
        echo'<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success mr-4" type="submit">Search</button>
        <p class="text-light my-0 mx-0">Welcome  '.$_SESSION['username'].'</p>
        <a  href="/discuss/component/logout.php" class="btn btn-primary ml-2 rounded-0" type="submit">LogOut</a>
      </form>';
      }
      else{
       echo'
      <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
    <div class="button  ">
    <button class="btn btn-primary my-2 my-sm-0 ml-5 rounded-0 " type="submit" data-bs-toggle="modal" data-bs-target="#loginModal" >Login</button>
    <button class=" btn btn-primary my-2 my-sm-0 mr-2 ml-2 rounded-0" type="submit" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
      }
      echo'
    </div>
    </div>
  </nav>';
  

   include 'component/loginmodal.php';
   include 'component/signupmodal.php';
   if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Success!</strong> You can now login
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
   }
   
   if(isset($_GET['error']))
   {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
              <strong>failed!</strong> '.$_GET['error'].'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
   }
  
  
?>
  
  