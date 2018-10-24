<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Message</title>
    <link rel="stylesheet" href="quick.css">
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
        $existingSubjects = array();
        if (file_exists("messages.txt") && filesize("messages.txt") > 0) {
            $messageArray = file("messages.txt");
            $count = count($messageArray);
            for ($i=0; $i < $count; $i++) { 
                $currMsg = explode("~", $messageArray[$i]);
                $existingSubjects[] = $currMsg[0];
                
            }
        }
        if (in_array($subject, $existingSubjects)) {
            echo "<p>The subject <em>\"$subject\"</em> you entered already exist!<br>\n";
            echo "Please enter a new subject amd try again.<br>\n";
            echo "Your message was not saved.</p>\n";
        } else {
            $messageRecord = "$subject~$name~$message\n";
            $fileHandle = fopen("messages.txt", "ab");
            if (!$fileHandle) {
                echo "There was an error saving your message!\n";
            } else {
                fwrite($fileHandle, $messageRecord);
                fclose($fileHandle);
                echo "Your message has been saved";
                $subject = "";
                $name = "";
                $message = "";
            }
        }
        
        
        // //debug
        // echo $messageRecord;
        // echo "$subject $name $message\n";

    }else {
        $subject = "";
        $name = "";
        $message = "";
    }

    ?>
    <img style="margin-left: auto; margin-right: auto; height: 5%; width: 5%; display: block;" src="http://www.findthatlogo.com/wp-content/gallery/aol-logos/aol-triangle-logo.jpg"></img>
    <h1 style="text-align: center;">Post New Message</h1>
    <hr>
    <form style="margin-left: auto; margin-right: auto;" action="PostMessage.php" method="post">
    
        <span style="font-weight: bold;">Subject: <input type="text" name="subject" value="<?php echo $subject?>"></input></span>
        <span style="font-weight: bold;">Name: <input type="text" name="name" value="<?php echo $name?>"></input></span>
        <br>
        <textarea name="message" cols="80" rows="6" style="margin: 10px 5px 5px;"><?php echo $message?></textarea><br>
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    
    </form>
    <hr>
    <p>
        <a style="text-align: center; display: block;"href="MessageBoard.php">View Message</a>    
    </p>
</body>
</html>