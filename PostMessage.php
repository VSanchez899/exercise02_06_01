<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Message</title>
</head>
<body>
    <?php
    //Entry code
    if (isset($_POST['submit'])) {
        $subject = stripslashes($_POST["subject"]);
        $name = stripslashes($_POST["name"]);
        $message = stripslashes($_POST["message"]);
        $subject = str_replace("~", "-", $subject);
        $name = str_replace("~", "-", $name);
        $message = str_replace("~", "-", $message);
        $messageRecord = "$subject~$name~$message\n";
        $fileHandle = fopen("messages.txt", "ab");
        if (!$fileHandle) {
            echo "There was an error saving your message!\n";
        } else {
            fwrite($fileHandle, $messageRecord);
            fclose($fileHandle);
            echo "Your message has been saved";
        }
        
        // //debug
        // echo $messageRecord;
        // echo "$subject $name $message\n";

    }
    ?>
    <img style="margin-left: auto; margin-right: auto; height: 5%; width: 5%; display: block;" src="http://www.findthatlogo.com/wp-content/gallery/aol-logos/aol-triangle-logo.jpg"></img>
    <h1 style="text-align: center;">Post New Message</h1>
    <hr>
    <form style="margin-left: auto; margin-right: auto;" action="PostMessage.php" method="post">
        <span style="font-weight: bold;">Subject: <input type="text" name="subject"></input></span>
        <span style="font-weight: bold;">Name: <input type="text" name="name"></input></span>
        <br>
        <textarea name="message" cols="80" rows="6" style="margin: 10px 5px 5px;"></textarea><br>
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    </form>
    <hr>
    <p>
        <a style="text-align: center; display: block;"href="MessageBoard.php">View Message</a>    
    </p>
</body>
</html>