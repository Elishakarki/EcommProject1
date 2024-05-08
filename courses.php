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
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="courses.css">
</head>

<body>

    <?php include('header.php'); ?>
   
    <section class="course-section" id="courses">
        <div class="row course">

            <?php
            // Fetch all videos from the database
            $sql = "SELECT * FROM videos";
            $result = $conn->query($sql);
          
            echo $result->num_rows;

            if ($result->num_rows > 0) {
               
                while ($row = $result->fetch_assoc()) {
                    $video_id = $row["id"];
                    $title = $row["title"];
                    $thumbnail_path = $row["thumbnail_path"];
                    $date_time_posted = $row["date_time_posted"];
                    $description = $row["description"];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="<?php echo $thumbnail_path; ?>" class="card-img-top thumbnail-image"
                                alt="<?php echo $title; ?>">


                            <div class="card-body">
                                <div class="text">
                                    <h4 class="card-title">
                                        <?php echo $title; ?>
                                    </h4>
                                    <div class="card-description">
                                        <?php echo $description; ?>
                                    </div>
                                    <div class=buttondate>
                                        <a href='storage.php?video_id=<?php echo $video_id; ?>'><button>Explore </button></a>
                                        <p class="card-text">
                                            <?php echo $date_time_posted; ?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
            } else {
                echo "0 results";
            }
            ?>
        <div class="uploadlink">
            <p>Do you want to upload your course?
                <a href='upload.php'>Click here.</a>
            </p>
        </div>
        </div>
    </section>
    <!-- footer section  -->
<?php include('footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>