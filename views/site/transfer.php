<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Transfer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to transfer:</p>
    <div class="row">
        <div class="col-lg-5">
 
<?php $form = ActiveForm::begin(['id' => 'form-transfer']); ?>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'amount')->textInput() ?>
                <div class="form-group">
<?= Html::submitButton('Transfer', ['class' => 'btn btn-primary', 'name' => 'transfer-button']) ?>
                </div>
<?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>