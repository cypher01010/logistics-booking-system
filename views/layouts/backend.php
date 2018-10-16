<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
	<!--[if !IE]><!-->
	<html lang="en" class="no-js">
		<head>
			<meta charset="utf-8"/>
			<title>Rich Resources Logistics</title>
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta content="width=device-width, initial-scale=1" name="viewport"/>
			<meta content="" name="description"/>
			<meta content="" name="author"/>

			<link href="/js/sortable/app.css" rel="stylesheet" type="text/css"/>

			<link href="/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
			<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

			<link rel="stylesheet" type="text/css" href="/global/plugins/select2/select2.css">
			<link rel="stylesheet" type="text/css" href="/global/plugins/bootstrap-datepicker/css/datepicker3.css">

			<link href="/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
			<link href="/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>

			<link href="/global/css/components.css?v=0.0.4" id="style_components" rel="stylesheet" type="text/css"/>
			<link href="/global/css/plugins.css" rel="stylesheet" type="text/css"/>
			<link href="/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
			<link href="/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
			<link href="/admin/layout/css/custom.css?v=0.0.3" rel="stylesheet" type="text/css"/>

			<link rel="shortcut icon" href="/favicon.ico"/>

			<script src="/global/plugins/jquery.min.js" type="text/javascript"></script>
			<script src="/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
			<script src="/global/plugins/moment.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
		</head>
		<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">
			<?php $this->beginBody() ?>
				<div class="page-header navbar navbar-fixed-top">
					<div class="page-header-inner">
						<div class="page-logo">
							<a href="<?php echo \Yii::$app->getUrlManager()->createUrl('site/index'); ?>">
								<span style="display:inline-block; font-size: 20px; padding: 8px; color:#fff">Rich Resources Logistics</span>
							</a>
							<div class="menu-toggler sidebar-toggler hide"></div>
						</div>
						<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
						</a>
						<div class="top-menu">
							<ul class="nav navbar-nav pull-right">
								<li class="dropdown dropdown-user">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										<span class="username ">Welcome, <?php echo Yii::$app->session->get('name') ?> </span>
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-default">
										<li>
											<a href="<?php echo \Yii::$app->urlManager->createUrl('user/info/index'); ?>">
												Settings
											</a>
										</li>
										<li class="divider">
										</li>
										
										<li>
											<a href="<?php echo \Yii::$app->urlManager->createUrl('user/logout/index'); ?>">
												Log Out
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="page-container">
					<div class="page-sidebar-wrapper">
						<?php echo $this->render('//etc/menus/backend', []); ?>
					</div>
					<div class="page-content-wrapper">
						<div class="page-content">
							<?php echo $content; ?>
						</div>
					</div>
				</div>
				<div class="page-footer">
					<div class="page-footer-inner">
						 2015 &copy; Rich Resources Logistics
					</div>
					<div class="scroll-to-top">
						<i class="icon-arrow-up"></i>
					</div>
				</div>
				<?php echo Html::csrfMetaTags(); ?>
			<?php $this->endBody() ?>
		</body>
		<script src="/js/fullcalendar.min.js"></script>
		<script src="/js/jquery.signaturepad.js" type="text/javascript"></script>

		<!--[if lt IE 9]>
		<script src="/global/plugins/respond.min.js"></script>
		<script src="/global/plugins/excanvas.min.js"></script> 
		<![endif]-->

		<script src="/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
		<script src="/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
		<script src="/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

		<script type="text/javascript" src="/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script type="text/javascript" src="/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
		<script type="text/javascript" src="/global/plugins/select2/select2.min.js"></script>

		<script src="/global/scripts/metronic.js" type="text/javascript"></script>
		<script src="/admin/layout/scripts/layout.js" type="text/javascript"></script>
		<script src="/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
		<script src="/admin/layout/scripts/demo.js" type="text/javascript"></script>
		<script src="/admin/pages/scripts/index.js" type="text/javascript"></script>
		<script src="/admin/pages/scripts/form-wizard.js"></script>
		<script src="/admin/pages/scripts/components-pickers.js"></script>

		<script type="text/javascript">
			jQuery(document).ready(function() {
				Metronic.init(); // init metronic core components
				Layout.init(); // init current layout
				QuickSidebar.init(); // init quick sidebar
				Demo.init(); // init demo features
				FormWizard.init();
				ComponentsPickers.init();
			});
		</script>

		<script src="/js/sortable/S2.js"></script>
	</html>
<?php $this->endPage() ?>