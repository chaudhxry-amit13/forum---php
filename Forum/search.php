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

        <div class="container">
            <h1>Search result for <em>"<?php echo $_GET['search'] ?>"</em> </h1>

            <?php
            $noresults = true;
            $query = $_GET["search"];
            $sql = "select * from threads where match (thread_subject, thread_desc) against ('$query')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_subject'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=" . $thread_id;
                $noresults = false;

                // Display the search result
                echo '<div class="result">
                        <h3><a href="' . $url . '" class="text-dark">' . $title . '</a> </h3>
                        <p>' . $desc . '</p>
                    </div>';
            }
            if ($noresults) {
                echo '<div class="container my-4 bg-secondary-subtle py-4">
            <div class="jumbotron">
                <P class="fw-midbold fs-4">No result</P>
                <p>this is a peer forum for sharing knowledge with each other</p>
            </div>
        </div>';
            }

            ?>
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