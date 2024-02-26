<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iforum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">about</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu">';
$sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
}
echo '</div>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <div class="d-flex mx-2">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<form class="d-flex mx-2 my-lg-0" role="search" method="get" action="search.php">
                    <input class="form-control mx-2 mr-sm-2-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <p class="text-light my-0 mx-2"> welcome' . $_SESSION['useremail'] . ' </p>
                    <a href="partials/logout.php" class="btn btn-outline-success ml-2">Logout</a>
                    </form>';
} else {
    echo '<form class="d-flex mx-2 my-lg-0" role="search">
                    <input class="form-control mx-2 mr-sm-2-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#signupModal">Login</button>
                <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">signup</button>';
}
echo '</div>
        </div>
    </div>
</nav>';
include 'partials/loginmodal.php';
include 'partials/signupmodal.php';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
