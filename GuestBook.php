<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="quick.css">
</head>
<body>
    <img style="margin-left: auto; margin-right: auto; height: 15%; width: 15%; display: block;" src="https://designcontest2-com-designcontest.netdna-ssl.com/data/contests/16267/entries/e773b788591bd4f3.png"></img>
    <h1 style="text-align: center;">Guest List</h1>
    <?php
    if (isset($_GET["action"])) {
        if (file_exists("Guest.txt") || filesize("Guest.txt") !== 0) {
            $messageArray = file("Guest.txt");
            switch ($_GET["action"]) {
                case 'Delete First':
                    array_shift($messageArray);
                    break;
                case 'Delete Last':
                    array_pop($messageArray);
                    break;
                case 'Delete Message':
                if (isset($_GET['message'])) {
                    array_splice($messageArray, $_GET['message'], 1);
                    // $index = $_GET['message'];
                    // unset($messageArray[$index]);
                    // $messageArray = array_values($messageArray);
                }
                    break;
                case 'Remove Duplicates':
                    $messageArray = array_unique($messageArray);
                    $messageArray = array_values($messageArray);
                    echo "<<pre>\n";
                    print_r($messageArray);
                    echo "</pre>\n";
                    break;
                case 'Sort Ascending':
                    sort($messageArray);
                    break;
                case 'Sort Descending':
                    rsort($messageArray);
                    break;
            }
            
            if (count($messageArray) > 0) {
                $newMessages = implode($messageArray);
                $fileHandle = fopen("Guest.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error updating the message file.\n";
                } else {
                    fwrite($fileHandle, $newMessages);
                    fclose($fileHandle);
                }
                
                echo "There are remaining Guest in the array.<br>";
                //debug
            } else {
                unlink("Guest.txt");
            }
            
            
            
        }
    }



    if (!file_exists("Guest.txt") || filesize("Guest.txt") == 0) {
        echo "<p style=\"text-align: center;\">There are no Guest posted.</p>\n";
    } else {
        $messageArray = file("Guest.txt");
        echo "<table style=\"background-color: lightgray;\" border=\"1\" width=\"100%\">\n";
        $count = count($messageArray);
        for ($i=0; $i < $count; $i++) { 
            $currMsg = explode("~", $messageArray[$i]);
            $keyMessageArray[$currMsg[0]] = $currMsg[1] . "~" . $currMsg[2];
        }
        $index = 1;
        $key = key($keyMessageArray);
        foreach ($keyMessageArray as $message) {
            $currMsg = explode("~", $message);
            echo "<tr>\n";
            echo "<td width=\"5%;\" style=\"text-align: center; font-weight: bold;\">" . $index . "</td>\n";
            echo "<td width=\"95%\"><span style=\"font-weight: bold\">Subject: </span>" . htmlentities($key) . "<br>\n";
            echo "<span style=\"font-weight: bold\">Name: </span>" . htmlentities($currMsg[0]) . "<br>\n";
            echo "<span style=\"text-decoration: underline; font-weight: bold;\">Message: </span><br>\n" . htmlentities($currMsg[1]) . "</td>\n";
            echo "<td width=\"105\" style=\"text-align: center\">" . "<a href='GuestBook.php?" . "action=Delete%20Message&" . "message=" . ($index - 1) ."'>" . "Delete This Message</a></td>\n";
            echo "</tr>\n";
            ++$index;
            next($keyMessageArray);
            $key = key($keyMessageArray);
        }
        echo "</table>\n";
    }
    
    ?>
    <p><a style="text-align: center; display: block;"href="PostGuest.php">Post New Message</a>
    <a style="text-align: center; display: block;" href="GuestBook.php?action=Sort%20Ascending">Sort Subjects A-Z</a>
    <a style="text-align: center; display: block;" href="GuestBook.php?action=Sort%20Descending">Sort Subjects Z-A</a>
    <a style="text-align: center; display: block;" href="GuestBook.php?action=Delete%20First">Delete First Message</a>
    <a style="text-align: center; display: block;" href="GuestBook.php?action=Delete%20Last">Delete last Message</a>
    <!-- <a style="text-align: center; display: block;" href="MessageBoard.php?action=Remove%20Duplicates">Remove Duplicates</a> -->
    </p>
</body>
</html>