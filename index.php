<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Login Type</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-style: oblique;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            /* Stack content vertically */
            position: relative;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        /* Background image with blur effect */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('2.jpeg');
            /* Set your image path here */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(8px);
            z-index: -1;
        }

      

        h1 {
            color: #ffffff;
            font-size: 36px;
            font-style: oblique;
            margin-bottom: 15px;
            font-family: 'Arial', sans-serif;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        h2,
        h3 {
            color: #ddd;
            font-size: 20px;
            font-style: oblique;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

 
    <?php include 'in_nav.php'; ?>
    <!-- Main container with welcome message -->
    <div class="container">
        <h1>Welcome to SMS</h1>
        <h2>Scholarship Management System</h2>
        <h3>Where Dream Becomes Reality</h3>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>