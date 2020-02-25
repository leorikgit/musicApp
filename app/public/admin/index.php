<?php
include_once __DIR__."../../../core/ini.php";

$user = new User();
$user->findUser();
$user->username = 'aaaaa';
$user->update();

echo $user->username;
if(!$user->findUser()->hasPermission('admin')){
    Redirect::to('index.php');
}
$deleteUSer = new User();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Hello <?php echo $user->username?> on Admin page
</body>
</html>