<?php

class LoginTest extends PHPUnit_Extensions_Selenium2TestCase {
  public function setUp()
  {
    $this->setBrowserUrl('http://localhost/TindaJaro');
    $this->setBrowser('firefox');
  }

  public function tearDown()
  {
    $this->stop();
  }

  public function testSignUpExist()
  {
    $this -> url( '/' );

    $link = $this -> byId( 'sign-up' );

    $this -> assertEquals( 'Sign up', $link -> text() );
  }

  public function testClickSignUp()
  {
    $this -> url( '/' );

    $link = $this -> byId( 'sign-up' );
    $link -> click();

    $this -> assertEquals( 'http://localhost/TindaJaro/registration/registration.php', $this -> url());
  }

  public function testRegistrationFormExist()
  {
    $this -> url ( 'http://localhost/TindaJaro/registration/registration.php' );

    $form = $this -> byId( 'Registration' );
    $action = $form -> attribute( 'action' );

    $this -> assertEquals( 'http://localhost/TindaJaro/registration/registration.php', $action);
  }

  public function testRegistrationFieldExist()
  {
    $this -> url( 'http://localhost/TindaJaro/registration/registration.php' );

    $firstname = $this -> byId( 'fst' );
    $lastname = $this -> byId( 'lst' );
    $gender = $this -> byName( 'sex' );
    $email = $this -> byId( 'eml' );
    $username = $this -> byId( 'usr' );
    $password = $this -> byId( 'pswrd' );
    $classification = $this -> byId( 'Vendor' );

    $this -> assertEquals( '', $firstname -> value() );
    $this -> assertEquals( '', $lastname -> value() );
    $this -> assertEquals( 'Male', $gender -> value() );
    $this -> assertEquals( '', $email -> value() );
    $this -> assertEquals( '', $username -> value() );
    $this -> assertEquals( '', $password -> value() );
    $this -> assertfalse( $classification -> selected() );
  }

  public function testRegistrationValid()
  {
    $this -> url( 'http://localhost/TindaJaro/registration/registration.php' );

    $firstname = $this -> byId( 'fst' );
    $lastname = $this -> byId( 'lst' );
    $gender = $this -> byId( 'female' );
    $email = $this -> byId( 'eml' );
    $username = $this -> byId( 'usr' );
    $password = $this -> byId( 'pswrd' );
    $classification = $this -> byId( 'Vendor' );
    $form = $this -> byId( 'Registration' );

    $firstname -> value( 'Mary' );
    $lastname -> value( 'Mondragon' );
    $gender -> click();
    $email -> value( 'Mary@yahoo.com' );
    $username -> value( 'mondragon' );
    $password -> value( 'marymary' );
    $classification -> click();

    $form -> submit();

    $this -> assertEquals( 'http://localhost/TindaJaro/index.php?success=true', $this -> url());

    $warning = $this -> byId( 'error' );

    $this -> assertEquals( 'You are successfully registered please log in', $warning -> text() );
  }

  public function testRegistrationInvalidUsername()
  {
    $this -> url( 'http://localhost/TindaJaro/registration/registration.php' );

    $firstname = $this -> byId( 'fst' );
    $lastname = $this -> byId( 'lst' );
    $gender = $this -> byId( 'male' );
    $email = $this -> byId( 'eml' );
    $username = $this -> byId( 'usr' );
    $password = $this -> byId( 'pswrd' );
    // $classification = $this -> byId( 'Vendor' );
    $form = $this -> byId( 'Registration' );

    $firstname -> value( 'Mary' );
    $lastname -> value( 'Mondragon' );
    $gender -> click();
    $email -> value( 'Mary@yahoo.com' );
    $username -> value( 'karlo' );
    $password -> value( 'marymary' );
    // $classification -> click();

    $form -> submit();

    $error = $this -> byId( 'warning' );

    $this -> assertEquals( 'Username already exists!', $error -> text() );
  }

  public function testLoginFormExist()
  {
    $this -> url( '/' );

    $form = $this -> byId( 'Log-in' );
    $action = $form -> attribute( 'action' );

    $this -> assertEquals( 'http://localhost/TindaJaro/index.php', $action);
  }

  public function testLoginFieldExist()
  {
    $this -> url( '/' );

    $username = $this -> byId( 'username' );
    $password = $this -> byId( 'password' );

    $this -> assertEquals( '' , $username -> value() );
    $this -> assertEquals( '' , $password -> value() );
  }

  public function testLoginValid()
   {
    $this -> url( '/' );

    $username = $this -> byId( 'username' );
    $password = $this -> byId( 'password' );
    $form = $this -> byId( 'Log-in' );

    $username -> value( 'karlo' );
    $password -> value( 'karlo' );

    $form -> submit();

    $this -> assertEquals( 'http://localhost/TindaJaro/homepage/vendor.php', $this -> url() );

    $greeting = $this -> byId( 'greeting' );

    $this -> assertEquals( 'Welcome to TindaJaro.ph', $greeting -> text() );
  }

  public function testLoginInvalidUsername()
  {
    $this -> url( '/' );

    $username = $this -> byId( 'username' );
    $password = $this -> byId( 'password' );
    $form = $this -> byId( 'Log-in' );

    $username -> value( 'karlokarlo' );
    $password -> value( 'karlo' );

    $form -> submit();

    $fail = $this -> byId( 'error' );

    $this -> assertEquals( 'Invalid Username and Password TRY AGAIN', $fail -> text() );
  }

  public function testLoginInvalidPassword()
  {
    $this -> url( '/' );

    $username = $this -> byId( 'username' );
    $password = $this -> byId( 'password' );
    $form = $this -> byId( 'Log-in' );

    $username -> value( 'karlo' );
    $password -> value( 'karlokarlo' );

    $form -> submit();

    $fail = $this -> byId( 'error' );

    $this -> assertEquals( 'Invalid Username and Password TRY AGAIN', $fail -> text() );
  }
}

?>
