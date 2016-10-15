<?php
$fb = new Facebook\Facebook([
    'app_id' => '1909067872653575', // Replace {app-id} with your app id
    'app_secret' => 'bb71b82ba060f18a84363cf05552327c',
    'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://dev.events.it-zen.org/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>