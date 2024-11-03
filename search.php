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
    #maincontainer{
        min-height: 82vh;
    }
    #search
    {
          height: 50px;
          width: 100%;
          text-align: center;
          align-items: center;
          
    }
    #img
    {
        height: 30vh;
        margin-right: 60vh;
         
    }
    </style>
    <title>Welcome to I-Discuss</title>
</head>

<body>
    <?php include 'component/dbconnect.php';?>
    <?php include 'header.php';?>
    
       <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search result  for <em>"<?php echo $_GET['search'] ?>"</em></h1>

        <?php
        $noresult = true ;
     $query = $_GET['search'];
     $sql = "SELECT * FROM explore WHERE MATCH(explore_title, explore_desc) AGAINST ('$query'); ";
     $result =mysqli_query($conn, $sql);

    //fetch the category help of loop
     while($row = mysqli_fetch_assoc($result))
     {
        
      
        $title = $row['explore_title']; 
        $desc = $row['explore_desc']; 
        $explore_id = $row['explore_id'];
        $url = "explore.php?exploreid=" .$explore_id;
        $noresult = false ;
        echo'
            <div class="result">
            <h3><a href="' .$url. '" class="text-dark">' .$title. '</a></h3>
            <p>' .$desc. '</p>
            </div>';
     }
     if($noresult)
     {
              echo' <div class="jumbotronm jumbotron-fluid p-0">
                    <div class="container">
                    <p class="display-6 text-center">No Results Found...!</p>
                    <p class="lead text-center">Your search -'.$query.' - did not match any documents.<br>
                    <ul>
                     Suggestions:
                      <li>Make sure that all words are spelled correctly.</li> 
                      <li>Try different keywords.</li>
                      <li>Try more general keywords.</li>
                      <li>Try fewer keywords.</li>
                    </ul> 
                    <div class="img" id="search">
                    <img src="img/search.png" id="img" alt="SVG Example">
                    </div>
                     
                    </p>
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