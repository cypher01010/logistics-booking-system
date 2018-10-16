<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Rich Resources Logistics</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="/css/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/css/main.css?v=0.0.3" />
		<noscript><link rel="stylesheet" href="/css/noscript.css" /></noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="/css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 8]><script src="/css/ie/respond.min.js"></script><![endif]-->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-viewport.min.js"></script>
		<script src="/js/util.js"></script>
		<script src="/js/main.js"></script>
		<?php echo Html::csrfMetaTags(); ?>
		<link rel="shortcut icon" href="/favicon.ico"/>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div style="text-align: center; ">
					<a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['site/index']); ?>">
						<img src="/images/logo.png">
					</a>
				</div>
			</div>

			<nav id="nav">
				<a href="#customer" class="icon fa-user active" id="link-customer"><span>Customer</span></a>
				<a href="#driver" class="icon fa-truck" id="link-driver"><span>Driver</span></a>
				<a href="#admin" class="icon fa-gears" id="link-admin"><span>Admin</span></a>
			</nav>

			<div id="main">
				<?= $content ?>
			</div>

			<div id="footer">
				<ul class="copyright"><li>&copy; Rich Resources Logistics</li></ul>
			</div>
		</div>
	</body>
</html>