<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Message</title>
</head>
<body>
    <?php
    if (isset($_POST['submit'])) {
        
    }
    ?>

    <h1>Post New Message</h1>
    <hr>
    <form action="PostMessage.php" method="post">
        <span style="font-weight: bold;">Subject: <input type="text" name="subject"></input></span>
        <span style="font-weight: bold;">Name: <input type="text" name="name"></input></span>
        <textarea name="message" cols="8" rows="6" style="margin: 10px 5px 5px;"></textarea><br>
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    </form>
    <hr>
    <p>
        <a href="MessageBoard.php">View Message</a>    
    </p>
</body>
</html>