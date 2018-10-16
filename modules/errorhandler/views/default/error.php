<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $name;
?>
<article class="panel">
	<header>
		<h2><?= Html::encode($this->title) ?></h2>
	</header>
	<div>
		<?= nl2br(Html::encode($message)) ?>
	</div>
</article>