<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Profile : <?=$user->username?>
    </p>
    <p>
      Balans : <?= number_format($user->balans,2) ?>
    </p>

    <?php if (is_array($op_from)&&(!empty($op_from))): ?>
    <h3> History comming transfers</h3>
    <table class="table tab table-striped">
      <tr>
        <th>№</th>
        <th>From</th>
        <th>Amount</th>
        <th>Date</th>
      </tr>
      <?php foreach ($op_from as $key => $value) :?>
      <tr>
        <td><?=$value->id?></td>
        <td><?= $value->user_from->username ?></td>
        <td><?= $value->amount ?></td>
        <td><?= $value->date_create ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <?php endif;?>
    
    <?php if (is_array($op_to) && (!empty($op_to))): ?>
      <h3> History upcomming transfers</h3>
      <table class="table tab table-striped">
        <tr>
          <th>№</th>
          <th>To</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
        <?php foreach ($op_to as $key => $value) : ?>
          <tr>
            <td><?= $value->id ?></td>
            <td><?= $value->user_to->username ?></td>
            <td><?= $value->amount ?></td>
            <td><?= $value->date_create ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
    
    
</div>
