<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searchFlight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flights-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'from') ?>

    <?= $form->field($model, 'to') ?>

    <?= $form->field($model, 'back') ?>

    <?= $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'stop') ?>

    <?php // echo $form->field($model, 'adult') ?>

    <?php // echo $form->field($model, 'child') ?>

    <?php // echo $form->field($model, 'infant') ?>

    <?php // echo $form->field($model, 'price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
