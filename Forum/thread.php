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



        <!-- fetching the from index to thread -->
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
        ?>

        <!-- method post means to insert the data to database -->
        <!-- make a sql query which connect it to data base if anyone type in it automatically save in db -->
        <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];  //it used for knowing about the request what is..?
        if ($method == 'POST') {
            // insert into thread into db
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $sql = "INSERT INTO `threads` (`thread_subject`, `thread_desc`, `thread_cat_id`, `thread_user_id`,
                    `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added please wait while someone respond.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        ?>

        <!-- category conatiner starts here using jumbotron from bootstrap -->
        <div class="container my-4 bg-secondary-subtle py-4">
            <div class="jumbotron">
                <h1 class="display-5"> Welcome to <?php echo $catname; ?> forum</h1>
                <P class="fw-midbold fs-4"><?php echo $catdesc; ?></P>
                <hr class="my-4">
                <p>this is a peer forum for sharing knowledge with each other</p>
                <a class="btn btn-success btn-lg" href="" role="button">Learn more</a>
            </div>
        </div>


        <!-- In it makes a form to type anything -->
        <!--  request uri help in to post the same page in database
            request uri is a string contengination -->
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container py-3">
            <h2>Start a Discussion</h2>
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fs-5">Problem title</label>
                    <input type="text" class="form-control border-dark-subtle" id="title" name="title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fs-5">Elaborate your concern</label>
                    <textarea class="form-control border-dark-subtle" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        } else {
            echo '<div class="container pt-4">
                    <p class="fs-5 text-danger bg-danger-subtle fw-medium">You are not logged in please login to be start discussion</p>
                </div>';
        }
        ?>

        <!-- method get means to getting the info from the database -->
        <!-- it show the thread form the database -->
        <div class="container mb-3 py-4">
            <h2>Browse questions</h2>
            <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;   //it only use to check the thread request has fetch in page
            while ($row = mysqli_fetch_assoc($result)) {  //in this we fetch the data by using this code
                $noresult = false;
                $id = $row['thread_id'];
                $title = $row['thread_subject'];
                $desc = $row['thread_desc'];
                $thread_time = $row['timestamp'];

                $thread_user_id = $row['thread_user_id'];
                $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);


                // cards code from bootstrap
                echo '<div class="d-flex mb-3 py-4">
                <div class="flex-shrink-0">
                    <img src="img/download.png" width="54px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="fw-bold my-0">' . $row2['user_email'] . ' at ' . $thread_time . '</p>
                    <a class="fw-bold text-md-end text-dark text-decoration-none"
                    href="threadlist.php?threadid=' . $id . '">' . $title . '</a><br>
                    ' . $desc . '
                </div>
            </div>';
            }

            // echo var_dump($noresult);   noresult help to give some command where no any request has been found it automaticaaly apply
            if ($noresult) {
                echo '<div class="jumbotron bg-secondary-subtle py-4">
                <div class= "container">
                    <p class="display-5">No threads has been found</p>
                    <p class="fw-midbold fs-4">Be the first person to ask a question</p>
                    </div>
                    </div>';
            }
            ?>
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