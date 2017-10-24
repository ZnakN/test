<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
  <div class="row">
    <div class="col-lg-6">
      <h1><?= Html::encode($this->title) ?></h1>

      <p>Please fill out the following fields to login:</p>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => ['site/login'],
    'method' => 'post',
    'layout' => 'horizontal',
    'fieldConfig' => [
      'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
  ]);
?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

      <?=
      $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-0 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
      ])
      ?>

      <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
      </div>

<?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-6">
      <h1>Registration</h1>
      <p>Please fill out the following fields to registration:</p>


<?php
$rform = ActiveForm::begin(['action' => ['site/signup'], 'method' => 'post', 'id' => 'form-signup', 'layout' => 'horizontal',
    'fieldConfig' => [
      'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
  ]);
?>
      <?= $form->field($rmodel, 'username')->textInput(['autofocus' => true]) ?>
      <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
          <?= Html::submitButton('Registration', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

        </div>
      </div>
      <?php ActiveForm::end(); ?>

    </div>

  </div>  

</div>
