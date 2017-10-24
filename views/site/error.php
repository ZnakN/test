<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->title = 'Error page';
?>
<div class="site-error">

  <h1><?= Html::encode($this->title) ?></h1>

  <div class="alert alert-danger">
<?php
if (is_array($message)):
  foreach ($message as $key => $value) :
    foreach ($value as $key => $v):
      echo nl2br(Html::encode($v));
    endforeach;
  endforeach;
else :
  echo nl2br(Html::encode($message));
endif;
?>

  </div>


  <p>
    <a href="/" class="btn btn-default">Home</a>
  </p>

</div>
