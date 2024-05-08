 <?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="storage.css">
</head>

<body>

    <!-- navbar section   -->

    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php"><i class="bi bi-book"></i>Learn Tech</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php">about us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses.php" style="color:#FFA500">courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">contact</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class='nav-link dropdown-toggle' href='edit.php?id=$res_id' id='dropdownMenuLink'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='bi bi-person'></i>
                                </a>


                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">

                                    <li>
                                        <?php

                                        $id = $_SESSION['id'];
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

                                        while ($result = mysqli_fetch_assoc($query)) {
                                            $res_username = $result['username'];
                                            $res_email = $result['email'];
                                            $res_id = $result['id'];
                                        }


                                        echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";


                                        ?>

                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="course-section" id="courses">

        <?php
        // Fetch all videos from the database
        if (isset($_GET['video_id'])) {
            $video_id = $_GET['video_id'];
            $sql = "SELECT * FROM videos WHERE id = $video_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $title = $row["title"];
                    $video_path = $row["video_path"];
                    $date_time_posted = $row["date_time_posted"];
                    $description = $row["description"];
                    ?>
                    <div class="text">
                        <h1 class="card-title">
                            <?php echo $title; ?>
                        </h1>
                        <div class="card-description">
                            <?php echo $description; ?>
                        </div>

                        <p class="card-text">
                            <?php echo "uploaded on:" . $date_time_posted; ?>
                        </p>

                        <video src="<?php echo $video_path; ?>" class="card-img-top course-video" alt="<?php echo $title; ?>"
                            controls>
                    </div>
                    <div class="buttons">
                        <a href='courses.php'><button>Explore More Courses</button></a>
                        <a href='upload.php'><button>Upload a course</button></a>
                    </div>
                    <?php
                }
            } else {
                echo "0 results";
            }
        }

        ?>
    </section>

</html> 

