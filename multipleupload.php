<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="courseTitle" class="required">Course Title:</label>
        <input type="text" class="form-control" id="courseTitle" name="courseTitle" required>
    </div>
    <div class="form-group">
        <label for="courseDescription" class="required">Course Description:</label>
        <textarea class="form-control" id="courseDescription" name="courseDescription" required></textarea>
    </div>
    <div class="form-group">
        <label for="moduleTitle" class="required">Module Title:</label>
        <input type="text" class="form-control" id="moduleTitle" name="moduleTitle" required>
    </div>
    <div class="form-group">
        <label for="moduleDescription" class="required">Module Description:</label>
        <textarea class="form-control" id="moduleDescription" name="moduleDescription" required></textarea>
    </div>
    <!-- Repeat these inputs as needed for each video -->
    <div class="form-group">
        <label for="video1" class="required">Video 1:</label>
        <input type="file" class="form-control-file" id="video1" name="video1" accept="video/*" required>
        <label for="thumbnail1" class="required">Thumbnail 1:</label>
        <input type="file" class="form-control-file" id="thumbnail1" name="thumbnail1" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

    
</body>
<?php 
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume user is logged in for simplicity
    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert course
        $courseStmt = $conn->prepare("INSERT INTO courses (title, description, instructor_username) VALUES (?, ?, ?)");
        $courseStmt->bind_param("sss", $_POST['courseTitle'], $_POST['courseDescription'], $_SESSION['username']);
        $courseStmt->execute();
        $courseId = $courseStmt->insert_id;

        // Insert module
        $moduleStmt = $conn->prepare("INSERT INTO modules (course_id, title, description) VALUES (?, ?, ?)");
        $moduleStmt->bind_param("iss", $courseId, $_POST['moduleTitle'], $_POST['moduleDescription']);
        $moduleStmt->execute();
        $moduleId = $moduleStmt->insert_id;

        // Handle each video and thumbnail
        foreach ($_FILES as $key => $file) {
            // Extract file data, check type, save files, and insert video data
            // This should include error handling as in your original script
        }

        // Commit transaction
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        // Handle error, possibly logging it and showing user-friendly message

    }
}
?>
</html>