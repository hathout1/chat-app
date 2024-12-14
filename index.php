<?php
$con = mysqli_connect("localhost", "root", "", "chat-data");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="chatbox">
            <?php
            $read = "SELECT * FROM `chats` ORDER BY `id` ASC";
            $sql = mysqli_query($con, $read);
            while ($row = mysqli_fetch_array($sql)) :
                $name = $row['name'];
                $msg = $row['msg'];
                $date = $row['date'];
            ?>
            <div class="data">
                <span><?php echo $name ?></span>
                <span>:</span>
                <span><?php echo $msg ?></span>
                <span><?php echo $date ?></span>
            </div>
            <?php endwhile; ?>
        </div>
        <form action="index.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter Your Name!">
            <label for="msg">Message</label>
            <textarea name="msg" placeholder="What's In Your Mind!"></textarea>
            <input type="submit" name="up" value="Send">
        </form>
        <?php
        if (isset($_POST['up'])) {
            $dataName = $_POST['name'];
            $dataMsg = $_POST['msg'];
            $insert = "INSERT INTO `chats` (`name`,`msg`) VALUES ('$dataName' , '$dataMsg')";
            $send = mysqli_query($con, $insert);
            header('location: index.php');
        }
        ?>
    </div>
</body>

</html>