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

        <!-- getting the data from the database -->
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_subject'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            // query used for getting the user table to find out email name 
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        }
        ?>

        <!-- making of sql query for connect to the database when we type some comment it connect ot database -->
        <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            // insert into comment into db
            $comment = $_POST['comment'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, 
                    `comment_time`) VALUES ( '$comment', '$id', '0', current_timestamp())";

            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your comment has been added!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        ?>

        <!-- using jumbotron from bootstrap -->
        <div class="container my-4 bg-secondary-subtle py-4">
            <div class="jumbotron">
                <h1 class="display-5"><?php echo $title; ?> forum</h1>
                <P class="lead"><?php echo $desc; ?></P>
                <hr class="my-4">
                <p>This is a peer forum for sharing knowledge with each other</p>
                <p class="fw-bold">Posted by <?php echo $posted_by;  ?></p>
            </div>
        </div>

        <!-- make a from to type a comment -->
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container">
            <h2>Post a Comment</h2>
            <!-- request uri help in to post the same page in database -->
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                    <textarea class="form-control border-dark-subtle" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post comment</button>
            </form>
        </div>';
        } else {
            echo '<div class="container pt-4">
                    <p class="fs-5 text-danger bg-danger-subtle fw-medium">You are not logged in please login to be Post comments</p>
                </div>';
        }
        ?>

        <!-- there are comments  -->
        <div class="container " id="ques">
            <h2 class="py-2">Discussions</h2>
            <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            $noresult = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $noresult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];

                $comment_by = $row['comment_by'];
                $sql2 = "SELECT user_email FROM `users` WHERE sno='$comment_by'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="d-flex mb-5 py-2">
                <div class="flex-shrink-0">
                    <img src="img/download.png" width="54px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="fw-bold my-0"> ' . $row2['user_email'] . ' at ' . $comment_time . '</p>
                    ' . $content . '
                </div>
            </div>';
            }
            ?>


            <!--if no comments are instered then it will shown  -->
            <?php
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