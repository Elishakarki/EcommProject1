<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .required::after {
            content: "*";
            color: red;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Upload Video</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" class="required">Title:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>
            <div class="form-group">
                <label for="description" class="required">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="Enter description" required></textarea>
            </div>
            <div class="form-group">
                <label for="video" class="required">Video:</label>
                <input type="file" class="form-control-file" id="video" name="video" accept="video/*" required>
            </div>
            <div class="form-group">
                <label for="thumbnail" class="required">Thumbnail:</label>
                <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>

</html>



<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure user is logged in
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit;
    }

    // Validate file upload
    if (isset($_POST['title'], $_POST['description'], $_FILES['video'], $_FILES['thumbnail'])) {
        $title = htmlspecialchars($_POST['title']);
        $description = htmlspecialchars($_POST['description']);
        $video = $_FILES['video'];
        $thumbnail = $_FILES['thumbnail'];
        $username = $_SESSION['username'];
        $date_time_posted = date("Y-m-d H:i:s");

        // Check file extensions
        $allowed_video_extensions = ["mp4", "avi", "mov", "mpg", "mpeg"];
        $allowed_thumbnail_extensions = ["jpg", "jpeg", "png"];
        $video_extension = strtolower(pathinfo($video['name'], PATHINFO_EXTENSION));
        $thumbnail_extension = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));

        if (!in_array($video_extension, $allowed_video_extensions) || !in_array($thumbnail_extension, $allowed_thumbnail_extensions)) {
            echo "Invalid file format!";
            exit;
        }

        // Handle file storage
        $video_name = bin2hex(random_bytes(10)) . ".$video_extension";
        $thumbnail_name = bin2hex(random_bytes(10)) . ".$thumbnail_extension";
        $video_path = "videos/" . $video_name;
        $thumbnail_path = "thumbnails/" . $thumbnail_name;

        if (move_uploaded_file($video['tmp_name'], $video_path) && move_uploaded_file($thumbnail['tmp_name'], $thumbnail_path)) {
            $sql = "INSERT INTO videos (title, description, video_path, thumbnail_path, username, date_time_posted) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $title, $description, $video_path, $thumbnail_path, $username, $date_time_posted);
            if ($stmt->execute()) {
                header("Location: storage.php");
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error uploading files!";
        }
    }
}
?>
