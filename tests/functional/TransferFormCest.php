<?php

class TransferFormCest {
  public $user;

  public function __construct() {
    $this->user = 'znak';
  }

  public function _before(\FunctionalTester $I) {
    $I->amOnRoute('/');
  }

  public function openTransferPage(\AcceptanceTester $I) {
    $I->see('Home', 'h1');
    $I->click('Login');
    $I->see('Login', 'h1');
    $I->submitForm('#login-form', [
      'LoginForm[username]' => $this->user,
    ]);
    $I->see('Logout (' . $this->user . ')');
    
    $I->see('Home', 'h1');
    $I->seeLink('Transfer');
    $res =  $I->click('Transfer');
    
    $I->see('Transfer','h1');
    
    $I->submitForm('#form-transfer', [
      'TransferForm[username]' => $this->user,
    ]);
  }

//  public function loginWithEmptyCredentials(\FunctionalTester $I) {
//    $I->submitForm('#login-form', []);
//    $I->expectTo('see validations errors');
//    $I->see('Username cannot be blank.');
//  }
//
//  public function loginWithWrongCredentials(\FunctionalTester $I) {
//    $I->submitForm('#login-form', [
//      'LoginForm[username]' => 'admin123231312313',
//    ]);
//    $I->expectTo('see validations errors');
//    $I->see('Incorrect username or password.');
//  }
//
//  public function registerUser(\FunctionalTester $I) {
//    $I->submitForm('#form-signup', [
//      'SignForm[username]' => $this->user,
//    ]);
//    $I->see('Logout (' . $this->user . ')');
//    $I->dontSeeElement('form#login-form');
//  }
//
//  public function registerSameUser(\FunctionalTester $I) {
//    $I->submitForm('#form-signup', [
//      'SignForm[username]' => $this->user,
//    ]);
//    $I->see('This username has already been taken');
//  }
//
//  public function loginSuccessfully(\FunctionalTester $I) {
//    $I->submitForm('#login-form', [
//      'LoginForm[username]' => $this->user,
//    ]);
//    $I->see('Logout (' . $this->user . ')');
//    $I->dontSeeElement('form#login-form');
//  }
}