<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vehicle */

$this->title = 'Update Vehicle: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vehicle-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
