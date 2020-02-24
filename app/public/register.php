<?php
include_once __DIR__ .'../../core/ini.php';
$userFormModel = new UserFormModel();
if( Input::exist('post') && Input::get('register')){
    if(Token::check(Input::get('token'))){

        $input = $_POST;

        foreach($input as $key =>$alue){
            $input[$key] = sanitaze($alue);
        }
//        $validation = new Validation();
//        $validation->check($input, array(
//            'username'=> array(
//                'required' => true,
//                'max'      => '30',
//                'min'      => '6'
//            ),
//            'email'=> array(
//                'required' => true,
//                'email' => true,
//                'unique' => 'users'
//
//            ),
//            'password'=> array(
//                'required' => true,
//                'max'      => '50',
//                'min'      => '6'
//            ),
//            'password_again'=> array(
//                'required' => true,
//                'max'      => '50',
//                'min'      => '6',
//                'match' =>'password'
//            ),
//        ));
//        if($validation->passed()){
//            try {
//                $user = new User();
//                $user->register(array(
//                    'username' => $input['username'],
//                    'password' => $input['password'],
//                    'email' => $input['email']
//                ));
//                Session::flash('success', 'success!');
//
//                Redirect::to('index.php');
//            }catch (Exception $e){
//            die($e->getMessage());
//            }
//        }else{
//            var_dump($validation->getErrors());
//        }
        $userFormModel->load($input);


        if($userFormModel->register()) {

            $user =  new User();
            $user->register(array(
                    'username' => $input['username'],
                    'email' => $input['email'],
                    'password' => $input['password'],
            ));
                Session::flash('success', 'Account has been created!');

                Redirect::to('login.php');

        }
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL."assets/css/styles.css"?>">

</head>
<body>
    <div id="background">
        <div id="registerContainer">
            <div id="inputContainer">
                <h1>Register</h1>
                <form method="POST" action="<?php echo BASE_URL."register.php"?>">
                    <p>
                        <span class="validationError"><?php echo $userFormModel->getError('username')?$userFormModel->getError('username'):''?></span>
                        <label for="username">Username</label>
                        <input type="text" value="<?php echo Input::get('username')?>" name="username" id="username" placeholder="e.g vidavi">
                    </p>
                    <p>
                        <span class="validationError"><?php echo $userFormModel->getError('email')?$userFormModel->getError('email'):''?></span>
                        <label for="email">Email</label>
                        <input type="Email" value="<?php echo Input::get('email')?>" name="email" id="email" placeholder="e.g vidavi@gmail.com">
                    </p>
                    <p>
                        <label for="password">Password</label>
                        <input type="password" value="" name="password" id="password" placeholder="Yout password">
                    </p>
                    <p>
                        <label for="password_again">Password again</label>
                        <input type="password" value="" name="password_again" id="password_again" placeholder="Your password again">
                    </p>
                    <input type="hidden" name="token" value="<?php echo Token::tokenForm()?>">
                    <button type="submit" name="register" value="register">Submit</button>
                </form>
                <div id="hasAccountText">
                    <a href="<?php echo BASE_URL."login.php" ?>">Already have an account? Log in here.</a>
                </div>
            </div>
            <div id="registerText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free.</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>

        </div>

    </div>
</body>
</html>