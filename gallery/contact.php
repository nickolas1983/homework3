<?php
/* logic */

function clearMessage($message) {
    $bannedWords = array (
        'xxx', 'zzz', 'yyy'
    );

    $message = str_replace($bannedWords, '#BANNED#', $message);

    return $message;
}

$messages = array();
if(file_exists('data.txt')) {
    $storedMessages = unserialize(file_get_contents('data.txt'));
    if(is_array($storedMessages)) {
        $messages = $storedMessages;
    }

}

$userMessage = '';

/* adding message */
if(isset($_POST['action']) && $_POST['action'] == 'add') {

    if(!isset($_POST['username']) || !$_POST['username']) {
        $_POST['username'] = 'Anonimus';
    }

    if(isset($_POST['message']) && $_POST['message']) {
        $messages[] = array(
            'username' => $_POST['username'],
            'message' => $_POST['message']
        );
        $userMessage = '<span>Your message was added!</span>';

    } else {

        $userMessage = '<span style="color:red">Message is required!</span>';
    }
}

file_put_contents('data.txt', serialize($messages) );
?>
<h1>Add your message:</h1>
<?php if($userMessage) { ?>
    <p><?php echo $userMessage ?></p>
<?php } ?>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">

    <div style="clear:both"></div>

    <label for="message">Message *:</label>
    <textarea name="message" id="message" cols="30" rows="10"></textarea>

    <div style="clear:both"></div>

    <input type="submit" value="Add message">
    <input type="hidden" name="action" value="add">
</form>

<?php
foreach($messages as $message) { ?>
   <div>
       <h5><?php echo $message['username']?></h5>
       <p><?php echo clearMessage($message['message'])?></p>
   </div>
<?php }













