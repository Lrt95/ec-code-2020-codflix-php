<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function signup() {
    $user = new User();
    $error_msg = "";
    try {
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"], $_POST["password_confirm"]);
        $user->createUser();
    }
    catch (Exception $e) {
        $error_msg = $e->getMessage();
    } finally {
        return $error_msg;
    }
}
