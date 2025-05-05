<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .box {
    width: 100%; /* Set the width of the box */
    height: 300px; /* Set the height of the box */
    overflow: hidden; /* Hide any part of the image that goes outside the box */
    position: relative;
}

.box img {
    width: 100%; /* Make the image take up the full width of the box */
    height: 100%; /* Make the image take up the full height of the box */
    object-fit: cover; /* Ensure the image fills the box without distortion */
    object-position: center; /* Optionally, you can adjust the image position */
}

    </style>
</head>
<body>
<div class="box">
    <img src="images/untitled.png" alt="Image">
</div>

</body>
</html>