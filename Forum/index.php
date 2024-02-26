<!doctype html>
<html lang="en">

<head>
    <title>iforum</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
        <?php include 'partials/dbconnection.php'; ?>
        <?php include 'partials/navbar.php'; ?>

        <!-- slider start -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/1.jpg" height="500" width="400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/2.jpg" height="500" width="400" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/3.jpg" height="500" width="400" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!--categories start here  -->
        <div class="container-fluid mb-5">
            <div class="container">
                <h2 class="text-center py-3">Welcome to iforum - categories</h2>
                <div class="row">
                    <!-- fetch all the cateogories -->
                    <!-- use a for loop to iterate through categories -->

                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        // echo $row['category_id'];
                        // echo $row['category_name'];
                        $id = $row['category_id'];
                        $cat = $row['category_name'];
                        $desc = $row['category_description'];
                        echo '<div class="col-md-4">
                                <div class="card d-flex align-items-center border-0">
                                    <div class="card" style="width: 18rem;">
                                        <img src="img/card-' . $id . '.jpeg" class="card-img-top" alt="image for category">
                                        <div class="card-body">
                                            <h5 class="card-title"><a href="/php1/forum/thread.php?catid=' . $id . '">' . $cat . '</a></h5>
                                            <p class="card-text">' . substr($desc, 0, 40) . '...</p> 
                                                <a href="/php1/forum/thread.php?catid=' . $id . '" class="btn btn-primary">View Thread</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                    <!-- use a for loop to iterate through categories -->

                </div>
            </div>
        </div>
        <?php include 'partials/fotter.php'; ?>
    </header>
    <main></main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>