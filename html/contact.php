<?php

$name = getPostVars('name');
$email = getPostVars('email');
$domain = getPostVars('domain');
$message = getPostVars('message');

$host = getenv("DB_HOST");
$user = getenv("DB_UESR");
$pass = getenv("DB_PASS");
$bast = getenv("DB_NAME");

$query = array();

if (sendContactInfo($email, $name, $domain, $message)) {

} else {
    exit("Error sending mail");
}

header("Location: /index.html?".http_build_query($query));



function getPostVars($key = null)
{
    if (is_null($key)) {
        return $_POST;
    }
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return null;
}

function sendContactInfo($pdo, $email, $name, $domain, $message)
{
    $stmt = $pdo->prepare('INSERT INTO contacts (name, email, domain, message) VALUES (:name,:email,:domain,:message)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':domain', $domain);
    $stmt->bindParam(':message', $message);

    $stmt->execute();

    return true;
}
