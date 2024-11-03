
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
    .container{
        min-height: 70rem;
    }
    </style>
    <title>Welcome to I-Discuss</title>
</head>

<body>
    <?php include 'component/dbconnect.php';?>
    <?php include 'header.php';?>
    

    <!--carousel slider here-->

    <div id="carouselExampleIndicators" class="carousel slide overflow-hidden " style=" height:30rem;"
        data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner overflow-hidden">
            <div class="carousel-item active overflow-hidden">
                <img src="https://source.unsplash.com/random/2400×700/?coding,python" class="d-block w-100 overflow-hidden "
                    alt="...">
            </div>
            <div class="carousel-item overflow-hidden">
                <img src="https://source.unsplash.com/random/2400×700/?coding,reactjs" class="d-block w-100 overflow-hidden "
                    alt="...">
            </div>
            <div class="carousel-item overflow-hidden ">
                <img src="https://source.unsplash.com/random/2400×700/?java,coding" class="d-block w-100 overflow-hidden "
                    alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!---  category Card is here-->

    <div class="container">
        <h1 class="text-center my-3">Categories</h1>
        <div class="row">

            <!--fetch category from database-->

            <?php

        $sql = "SELECT * FROM `category`";
        $result =mysqli_query($conn, $sql);

       //fetch the category help of loop
        while($row = mysqli_fetch_assoc($result))
        {
            //echo $row['category_id'];
           // echo $row['category_name'];
        
          $cat_id = $row['category_id'];
          $cat_name = $row['category_name'];
          $cat_desc = $row['category_desc'];
       
         echo'
            <div class="col-md-4 my-3 overflow-hidden ">
                <div class="card  " style="width: 18rem;">
                    <a href="explorelist.php?catid='.$cat_id.'" ><img src="https://source.unsplash.com/random/500×400/?coding,'.$cat_name. '"  class="card-img-top overflow-hidden " style=" height:15rem;" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">' .$cat_name. '</h5>
                        <p class="card-text">' .substr($cat_desc,0, 100). '...</p>
                        <a href="explorelist.php?catid='.$cat_id.'"  class="btn btn-primary"> Explore More..</a>
                    </div>
                </div>
            </div>';
  
        }
    ?>



        </div>

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