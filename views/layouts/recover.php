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
		<!-- Scripts -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/skel.min.js"></script>
		<script src="/js/skel-viewport.min.js"></script>
		<script src="/js/util.js"></script>
		<script src="/js/main.js"></script>
		<link rel="shortcut icon" href="/favicon.ico"/>
	</head>
	<body>
		<!-- Wrapper-->
		<div id="wrapper" class="recover-container">
			<div id="header">
				<div style="text-align: center; ">
					<a href="<?php echo \Yii::$app->getUrlManager()->createUrl(['site/index']); ?>">
						<img src="/images/logo.png">
					</a>
				</div>
			</div>
			<!-- Main -->
			<div id="main" style="margin-top: 50px;">
				 <?= $content ?>
			</div>
			<!-- Footer -->
			<div id="footer">
				<ul class="copyright">
					<li>&copy; Rich Resources Logistics</li>
				</ul>
			</div>
		</div>
	</body>
</html>