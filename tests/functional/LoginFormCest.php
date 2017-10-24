<?php

class LoginFormCest {
  public $user;

  public function __construct() {
    $this->user = 'znak' . date('His');
  }

  public function _before(\FunctionalTester $I) {
    $I->amOnRoute('site/login');
  }

  public function openLoginPage(\FunctionalTester $I) {
    $I->see('Login', 'h1');
  }

  public function loginWithEmptyCredentials(\FunctionalTester $I) {
    $I->submitForm('#login-form', []);
    $I->expectTo('see validations errors');
    $I->see('Username cannot be blank.');
  }

  public function loginWithWrongCredentials(\FunctionalTester $I) {
    $I->submitForm('#login-form', [
      'LoginForm[username]' => 'admin123231312313',
    ]);
    $I->expectTo('see validations errors');
    $I->see('Incorrect username or password.');
  }

  public function registerUser(\FunctionalTester $I) {
    $I->submitForm('#form-signup', [
      'SignForm[username]' => $this->user,
    ]);
    $I->see('Logout (' . $this->user . ')');
    $I->dontSeeElement('form#login-form');
  }

  public function registerSameUser(\FunctionalTester $I) {
    $I->submitForm('#form-signup', [
      'SignForm[username]' => $this->user,
    ]);
    $I->see('This username has already been taken');
  }

  public function loginSuccessfully(\FunctionalTester $I) {
    $I->submitForm('#login-form', [
      'LoginForm[username]' => $this->user,
    ]);
    $I->see('Logout (' . $this->user . ')');
    $I->dontSeeElement('form#login-form');
  }
}