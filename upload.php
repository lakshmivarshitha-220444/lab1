<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>File Upload & Download</title>
</head>
<body>

<h2>File Upload & Download System</h2>

<?php

$folder = "uploads/";


if (!is_dir($folder)) {
    mkdir($folder);
}


if (isset($_GET['download'])) {

    $file = $folder . basename($_GET['download']);

    if (file_exists($file)) {

        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . basename($file));
        header("Content-Length: " . filesize($file));

        readfile($file);
        exit;
    }
}


if (isset($_POST['upload'])) {

    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] == 0) {

        $name = $_FILES['myfile']['name'];
        $temp = $_FILES['myfile']['tmp_name'];

        $path = $folder . $name;

        if (move_uploaded_file($temp, $path)) {

            echo "<p style='color:green;'>File uploaded successfully!</p>";

            echo "<a href='?download=$name'>
                    <button>Download File</button>
                 </a>";
        } else {
            echo "<p style='color:red;'>Upload failed!</p>";
        }

    } else {
        echo "<p style='color:red;'>No file selected!</p>";
    }
}

?>

<form method="post" enctype="multipart/form-data">

    Select File:
    <input type="file" name="myfile" required>
    <br><br>

    <input type="submit" name="upload" value="Upload File">

</form>

</body>
</html>
