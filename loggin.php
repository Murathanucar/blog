<?php
require_once  __DIR__ ."/vendor/autoload.php";


/**
 * Created by PhpStorm.
 * User: murathan
 * Date: 16.08.2017
 * Time: 14:46
 */
if($_POST){

    $user = new \src\controller\UserController();
    $user->adminLogin();

}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hafta1 Blog Yonetimi</title>

  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Lutfen giris yapınız</h2>
        <label for="text" class="sr-only"></label>
        <input type="text" name="userName" class="form-control" placeholder="Kullanici Adi" required autofocus>
        <label for="inputPassword" class="sr-only">Parola</label>
        <input type="password" name="password" class="form-control" placeholder="Parola" required>
        <div class="checkbox">

        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Giris yap</button>
      </form>

    </div> <!-- /container -->


    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
