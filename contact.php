<?php include 'in_nav.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgba(0, 0, 0, 0.7);

        }

        .header {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .content {
            color: white;
            padding: 40px;
            margin: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1{
            text-align: center;
            
        }
       h1, h2 {
            
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>



    <div class="content">
        <h1>Contact Us</h1>
        <h2>Get in Touch</h2>
        <p>We would love to hear from you! Whether you have a question, feedback, or need assistance, please reach out to us using the form below.</p>

        <!-- Contact Form -->
        <form method="POST" action="contact.php">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" name="name" id="name" required placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" required placeholder="Enter subject">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" id="message" required placeholder="Write your message"></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>