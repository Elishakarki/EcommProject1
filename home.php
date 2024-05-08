<?php
session_start();

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

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- navbar section   -->

    <?php include('header.php'); ?>

    <div class="name">
        <center>Welcome
            <?php
            // echo $_SESSION['valid'];
            
            echo $_SESSION['username'];

            ?>
            !
        </center>
    </div>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>Learn Something New everyday.</h1>
                    <p>We develop targeted approaches to connect you with aspiring programmers and tech enthusiasts
                        across various online platforms.
                    </p>
                    <button class="btn"><a href="courses.php">Explore Courses</a></button>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="images/hero-image.png" alt="" class="img-fluid">
                </div>

            </div>
        </div>
    </section>

    <!-- services section  -->

    <section class="services-section" id="services">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12 services">

                    <div class="row row1">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/research.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Diverse Course Offerings</h4>
                                    <p class="card-text">We provide a wide range of programming courses, from beginner
                                        to advanced levels.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/interactive.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Interactive Learning Platform</h4>
                                    <p class="card-text">Dive into hands-on exercises and projects for practical
                                        skill-building.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row row2">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/ux.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Customized Learning Paths</h4>
                                    <p class="card-text">Personalized learning journeys cater to individual goals and
                                        preferences.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/app-development.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Expert Mentorship</h4>
                                    <p class="card-text">Access experienced instructors and mentors for guidance and
                                        support.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 text-content">
                    <h3>services</h3>
                    <h1>We can help you solve your problem through our service.</h1>
                    <p>We are an online programming course platform dedicated to crafting coding experiences that
                        resonate with learners, empowering them to master essential programming skills. With over a
                          decade of expertise, we're committed to fostering a culture of learning and skill development in
                        the digital realm.</p>
                    <button class="btn">Explore Services</button>
                </div>

            </div>
        </div>
    </section>

    <!-- about section  -->

    <section class="about-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="images/about.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-content">
                    <h3>who we are</h3>
                    <h1>Fueling coding aspirations with innovative tech solutions.</h1>

                    <p>Empowering aspiring programmers with innovative technology solutions and creative learning
                        experiences. Our platform caters to growing minds seeking to master programming skills,
                        providing a dynamic environment where creativity meets cutting-edge technology to foster growth
                        and proficiency in coding.</p>
                    <button>learn more</button>
                </div>
            </div>
        </div>
    </section>

    <!-- courses section  -->

    <section class="course-section" id="courses">
        <div class="container">
            <div class="row text">
                <div class="col-lg-6 col-md-12">
                    <h3>Discover Our Courses</h3>
                    <h1>Fresh Additions</h1>
                    <hr>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>We're passionate about crafting meaningful educational experiences. Let us turn your aspirations
                        into reality and help you succeed with an exceptional learning journey.</p>
                </div>
            </div>
            <div class="row course">

                <?php
                // Fetch all videos from the database
                $sql = "SELECT * FROM videos LIMIT 6";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
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
            </div>
    </section>
    <!-- contact section -->
    <section class="contact-section" id="contact">
        <div class="container">

            <div class="row gy-4">

                <h1>contact us</h1>
                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Address</h3>
                                <p>Amrit Science Campus<br>Thamel, Kathmandu</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Call Us</h3>
                                <p>+977 9860343549<br>+977 989844900509</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Us</h3>
                                <p>learntech@gmail.com<br>learn@gmail.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Open Hours</h3>
                                <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 form">
                    <form action="contact.php" method="POST" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                    required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit">Send Message</button>
                            </div>

                        </div>
                    </form>

                </div>

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