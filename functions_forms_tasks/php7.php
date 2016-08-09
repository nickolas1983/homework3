<?php
/* logic */

function clearMessage($message)
{
    $bannedWords = array(
        'xxx', 'zzz', 'yyy'
    );
    $message = str_replace($bannedWords, '#BANNED#', $message);
    return $message;
}

$messages = array();
if (file_exists('php7.txt')) {
    $storedMessages = unserialize(file_get_contents('php7.txt'));
    if (is_array($messages)) {
        $messages = $storedMessages;
    }
}


$userMessage = '';

/* add message */
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    if (!isset($_POST['username']) || !$_POST['username']) {
        $_POST['username'] = 'Anonimus';
    }
    if (!isset($_POST['message']) || !$_POST['message']) {
        $userMessage = 'Message is requered';
    } else {
        $messages[] = array(
            'username' => $_POST['username'],
            'message' => $_POST['message']
        );
        $userMessage = 'Your message was added!';
    }

}
file_put_contents('php7.txt', serialize($messages));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1>Add you message</h1>

<?php if ($userMessage) {?>

    <p><?php echo "$userMessage"; ?></p>

<?php }?>

<?php foreach ($messages as $message) {    ?>
    <div>
        <h5><?php echo $message['username'] ?></h5>
        <p><?php echo clearMessage($message['message']) ?></p>
    </div>

<?php } ?>

<form method="post" action="">
    <label for="username">Username:</label><br>
    <input name="username" type="text" id="username"><br>

    <label for="message">Message:</label><br>
    <textarea name="message" id="message" cols="30" rows="10"></textarea><br>

    <input type="submit" value="Add message"><br>
    <input type="hidden" name="action" value="add"><br>
</form>

</body>
</html>