<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="new.css">
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
        if (file_exists("Guest.txt") && filesize("Guest.txt") > 0) {
            $messageArray = file("Guest.txt");
            $count = count($messageArray);
            for ($i=0; $i < $count; $i++) { 
                $currMsg = explode("~", $messageArray[$i]);
                $existingSubjects[] = $currMsg[0];
                
            }
        }
        if (in_array($subject, $existingSubjects)) {
            echo "<p>The name <em>\"$subject\"</em> already exist on the list!<br>\n";
            echo "Please enter a new name and try again.<br>\n";
            echo "Your information was not saved.</p>\n";
        } else {
            $messageRecord = "$subject~$name~$message\n";
            $fileHandle = fopen("Guest.txt", "ab");
            if (!$fileHandle) {
                echo "There was an error saving your message!\n";
            } else {
                fwrite($fileHandle, $messageRecord);
                fclose($fileHandle);
                echo "Your name has been saved";
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
    <img style="margin-left: auto; margin-right: auto; height: 15%; width: 15%; display: block;" src="https://designcontest2-com-designcontest.netdna-ssl.com/data/contests/16267/entries/e773b788591bd4f3.png"></img>
    <hr>
        <form style="margin-left: auto; margin-right: auto;" action="PostGuest.php" method="post">
    
            <span style="font-weight: bold;">Name: <input type="text" name="subject" value="<?php echo $subject?>" required></input></span>
            <span style="font-weight: bold;">Email: <input type="email" name="name" value="<?php echo $name?>" required></input></span><br>
            <h3>Feedback: </h3><br>
            <textarea name="message" cols="80" rows="6" style="margin: 10px 5px 5px;"><?php echo $message?></textarea><br>
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Post Message">

        </form>
    <hr>

    <p>
        <a style="text-align: center; display: block;"href="GuestBook.php">View Guest List</a>    
    </p>
    </body>
</html>