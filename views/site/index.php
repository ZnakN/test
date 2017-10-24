<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php if (!Yii::$app->user->isGuest): ?>
    <p  id="mkt">
      <a href="/site/transfer" class="btn btn-default"  >Transfer</a>
    </p>
  <?php endif; ?>

  <?php if (Yii::$app->user->isGuest): ?>
    <?=
    GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
        'id',
        'username',
        //'auth_key',
        //'password_hash',
        // 'updated_at',
        // 'balans',
        [
          'attribute' => 'balans',
          'content' => function($data) {
            return number_format($data->balans, 2);
          }
        ],
      ],
    ]);
    ?>
  <?php else : ?>
    <?=
    GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
        'id',
        'username',
        //'auth_key',
        //'password_hash',
        // 'updated_at',
        // 'balans',
        [
          'attribute' => 'balans',
          'content' => function($data) {
            return number_format($data->balans, 2);
          }
        ],
        ['header' => 'Action',
          'content' => function($data) {
            if ($data->id != Yii::$app->user->id) {
              $link = '<a class="btn btn-default" href="/site/transfer/' . $data->id . '">Make transfer</a>';
            } else {
              $link = '';
            }
            return $link;
          }],
      ],
    ]);
    ?>
  <?php endif; ?>



</div>
