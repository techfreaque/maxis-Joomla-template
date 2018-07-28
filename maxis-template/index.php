<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

// Use of Google Font
if ($this->params->get('googleFont'))
{
	JHtml::_('stylesheet', 'https://fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$this->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$this->addStyleDeclaration('
	body.site {
		border-top: 3px solid ' . $this->params->get('templateColor') . ';
		background-color: ' . $this->params->get('templateBackgroundColor') . ';
	}
	a {
		color: ' . $this->params->get('templateColor') . ';
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: ' . $this->params->get('templateColor') . ';
	}');
}

// Check for a custom CSS file
JHtml::_('stylesheet', 'user.css', array('version' => 'auto', 'relative' => true));



// Check for a custom js file
JHtml::_('script', 'user.js', array('version' => 'auto', 'relative' => true));



// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount)
{
	$span = 'span6';
}
elseif ($position7ModuleCount && !$position8ModuleCount)
{
	$span = 'span9';
}
elseif (!$position7ModuleCount && $position8ModuleCount)
{
	$span = 'span9';
}
else
{
	$span = 'span12';
}

// Logo file or site title param
// if ($this->params->get('logoFile'))
//{
//	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
//}
//elseif ($this->params->get('sitetitle'))
//{
//	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
//}
//else
//{
//	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
//}
?>


<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- <link rel="stylesheet" href="templates/maxis-template/css/above-the-fold-head.css"> -->
	<style>



	.main-nav-right {
		float: right;
		margin-left: 20px;
		margin-right: 20px;
	}

	.main-nav-left {
		float: left;
		margin-left: 20px;
		margin-right: 20px;
	}

	.main-nav-middle {
		float: inline-end;
	}

	.ml-stack-nav {
	    position: fixed !important;
	    top: 70px !important;
		}

	.header-nav >	.nav.menu > li {

		    padding-right: 20px;
		    padding-top: 9px;

		}
		.ml-stack-nav-toggle {
		  position: relative;
		  display: inline-block;
		  overflow: hidden;
		  padding: 0;
		  width: 26px;
		  height: 22px;
		  border: 0;
		  background: none;
		  color: #525261;
		  cursor: pointer;
		  -webkit-appearance: none;
		     -moz-appearance: none;
		          appearance: none;
		}
		.ml-stack-nav-toggle__line {
		  position: absolute;
		  top: 0;
		  left: 0;
		  display: block;
		  width: 100%;
		  height: 4px;
		  border-radius: 9px;
		  background: #000;
		  opacity: 1;
		  -webkit-transition: 0.3s ease-in-out;
		  transition: 0.3s ease-in-out;
		  -webkit-transform: rotate(0deg);
		      -ms-transform: rotate(0deg);
		          transform: rotate(0deg);
		}
		.ml-stack-nav-toggle__line:nth-child(2) {
		  top: 9px;
		}
		.ml-stack-nav-toggle__line:nth-child(3) {
		  top: 18px;
		}
		.ml-stack-nav-toggle.is-active .ml-stack-nav-toggle__line:nth-child(1) {
		  top: 9px;
		  left: 50%;
		  width: 0;
		}
		.ml-stack-nav-toggle.is-active .ml-stack-nav-toggle__line:nth-child(2) {
		  -webkit-transform: rotate(45deg);
		      -ms-transform: rotate(45deg);
		          transform: rotate(45deg);
		}
		.ml-stack-nav-toggle.is-active .ml-stack-nav-toggle__line:nth-child(3) {
		  top: 9px;
		  -webkit-transform: rotate(-45deg);
		      -ms-transform: rotate(-45deg);
		          transform: rotate(-45deg);
		}
		.header-menu-item {
		    float: right;
		    list-style: none;
		    margin-top: 8px;
		    margin-right: 20px;
		}

		.header-menu-dropdown {
    position: absolute;
    top: 68px;
    right: 0;

    min-width: 350px;

		}
		.element-invisible {
			visibility: hidden!important;
			display: none!important;
		}

		.search.suche > .form-inline {
    margin: 0;

		max-width: 640px;
		-ms-flex: 1 1 0.000000001px;
		-webkit-flex: 1;
		flex: 1;
		flex-basis: 0%;
		-webkit-flex-basis: 0.000000001px;
		flex-basis: 0.000000001px;

		}


			.search.suche > .form-inline > .button:before {
				font-family: FontAwesome;
	    content: "\f1b9";
	    display: inline-block;
	    padding-right: 3px;
	    vertical-align: middle;
		}

/** material-kit **/

			html {
			  -webkit-text-size-adjust: 100%;
			  -ms-text-size-adjust: 100%;
			  -ms-overflow-style: scrollbar;
			  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
			}

			*,
			*::before,
			*::after {
			  box-sizing: border-box;
			}

			* {
			  -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
			  -webkit-tap-highlight-color: transparent;
			}

			@-ms-viewport {
			  width: device-width;
			}

			body {
			  background-color: #eee;
			  color: #3C4858;
			  font-weight: 300;
				margin: 0;
				font-family: "Roboto", "Helvetica", "Arial", sans-serif;
				font-size: 1rem;

				line-height: 1.5;
				text-align: left;
			}

		.navbar.fixed-top {
		  border-radius: 0;
		}
		.navbar {
		  border: 0;
		  border-radius: 3px;
		  padding: 0.625rem 0;
		  margin-bottom: 20px;
		  color: #555;
		  background-color: #fff !important;
		  box-shadow: 0 4px 18px 0px rgba(0, 0, 0, 0.12), 0 7px 10px -5px rgba(0, 0, 0, 0.15);
		}
		.animation-transition-fast,
		.bootstrap-datetimepicker-widget table td>div,
		.bootstrap-datetimepicker-widget table th>div,
		.bootstrap-datetimepicker-widget table th,
		.bootstrap-datetimepicker-widget table td span,
		.navbar,
		.bootstrap-tagsinput .tag,
		.bootstrap-tagsinput [data-role="remove"],
		.card-collapse .card-header a i {
		  -webkit-transition: all 150ms ease 0s;
		  -moz-transition: all 150ms ease 0s;
		  -o-transition: all 150ms ease 0s;
		  -ms-transition: all 150ms ease 0s;
		  transition: all 150ms ease 0s;
		}



		.fixed-top {
		  position: fixed;
		  top: 0;
		  right: 0;
		  left: 0;
		  z-index: 1030;
		}

		body,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.h1,
		.h2,
		.h3,
		.h4 {
		  font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		  font-weight: 300;
		  line-height: 1.5em;
		}

		h1,
		h2,
		h3,
		.h1,
		.h2,
		.h3 {
		  margin-top: 20px;
		  margin-bottom: 10px;
		}

		h4,
		h5,
		h6,
		.h4,
		.h5,
		.h6 {
		  margin-top: 10px;
		  margin-bottom: 10px;
		}

		html * {
		  -webkit-font-smoothing: antialiased;
		  -moz-osx-font-smoothing: grayscale;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
		  margin-top: 0;
		  margin-bottom: 0.5rem;
		}

		p {
		  margin-top: 0;
		  margin-bottom: 1rem;
		}


		h1,
		.h1 {
		  font-size: 3.3125rem;
		  line-height: 1.15em;
		}

		h2,
		.h2 {
		  font-size: 2.25rem;
		  line-height: 1.5em;
		}

		h3,
		.h3 {
		  font-size: 1.5625rem;
		  line-height: 1.4em;
		}

		h4,
		.h4 {
		  font-size: 1.125rem;
		  line-height: 1.5em;
		}

		h5,
		.h5 {
		  font-size: 1.0625rem;
		  line-height: 1.55em;
		  margin-bottom: 15px;
		}

		h6,
		.h6 {
		  font-size: 0.75rem;
		  text-transform: uppercase;
		  font-weight: 500;
		}

		p {
		  font-size: 14px;
		  margin: 0 0 10px;
		}

		b {
		  font-weight: 700;
		}

		small,
		.small {
		  font-size: 75%;
		  color: #777;
		}

		.title,
		.card-title,
		.info-title,
		.footer-brand,
		.footer-big h5,
		.footer-big h4,
		.media .media-heading {
		  font-weight: 700;
		  font-family: "Roboto Slab", "Times New Roman", serif;
		}

		.title,
		.title a,
		.card-title,
		.card-title a,
		.info-title,
		.info-title a,
		.footer-brand,
		.footer-brand a,
		.footer-big h5,
		.footer-big h5 a,
		.footer-big h4,
		.footer-big h4 a,
		.media .media-heading,
		.media .media-heading a {
		  color: #3C4858;
		  text-decoration: none;
		}

		h2.title {
		  margin-bottom: 1rem;
		}

		.description,
		.card-description,
		.footer-big p {
		  color: #999;
		}

		.text-warning {
		  color: #ff9800 !important;
		}

		.text-primary {
		  color: #9c27b0 !important;
		}

		.text-danger {
		  color: #f44336 !important;
		}

		.text-success {
		  color: #4caf50 !important;
		}

		.text-info {
		  color: #00bcd4 !important;
		}

		.text-rose {
		  color: #e91e63 !important;
		}

		.text-gray {
		  color: #999999 !important;
		}

		.dropdown-menu {
		  display: none;
		  padding: 0.3125rem 0;
		  border: 0;
		  opacity: 0;
		  transform: scale(0);
		  transform-origin: 0 0;
		  will-change: transform, opacity;
		  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1);
		  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		}
		.header-menu-dropdown.dropdown-menu {
		  position: absolute;
		  top: 100%;
		  right: 0;
			left: auto;
		}

		.dropdown-toggle:after {
		  will-change: transform;
		  transition: transform 150ms linear;
		}

		.dropdown-toggle::after {
		  display: inline-block;
		  width: 0;
		  height: 0;
		  margin-left: 0.255em;
		  vertical-align: 0.255em;
		  content: "";
		  border-top: 0.3em solid;
		  border-right: 0.3em solid transparent;
		  border-bottom: 0;
		  border-left: 0.3em solid transparent;
		}

		.dropdown.open > .dropdown-toggle:after {
			-webkit-transform: rotate(180deg);
			-moz-transform: rotate(180deg);
			-o-transform: rotate(180deg);
			-ms-transform: rotate(180deg);
			transform: rotate(180deg);
		}


/** material kit - duplicate above the fold **/

nav{display:block}p{margin-top:0;margin-bottom:1rem}ul{margin-top:0;margin-bottom:1rem}ul ul{margin-bottom:0}a{color:#9c27b0;text-decoration:none;background-color:transparent;-webkit-text-decoration-skip:objects}img{vertical-align:middle;border-style:none}label{display:inline-block;margin-bottom:.5rem}button{border-radius:0}input,button{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button,input{overflow:visible}button{text-transform:none}button,[type="submit"]{-webkit-appearance:button}button::-moz-focus-inner,[type="submit"]::-moz-focus-inner{padding:0;border-style:none}input[type="checkbox"]{box-sizing:border-box;padding:0}[type="search"]{outline-offset:-2px;-webkit-appearance:none}
[type="search"]::-webkit-search-cancel-button,[type="search"]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}nav{display:block}ul{margin-top:0;margin-bottom:1rem}ul ul{margin-bottom:0}a{color:#9c27b0;text-decoration:none;background-color:transparent;-webkit-text-decoration-skip:objects}img{vertical-align:middle;border-style:none}label{display:inline-block;margin-bottom:.5rem}
button{border-radius:0}input,button{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,input{overflow:visible}button{text-transform:none}button,[type="submit"]{-webkit-appearance:button}button::-moz-focus-inner,[type="submit"]::-moz-focus-inner{padding:0;border-style:none}input[type="checkbox"]{box-sizing:border-box;padding:0}
[type="search"]{outline-offset:-2px;-webkit-appearance:none}[type="search"]::-webkit-search-cancel-button,[type="search"]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col-md-8{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}@media (min-width:768px){.col-md-8{flex:0 0 66.666667%;max-width:66.666667%}}.form-inline{display:flex;flex-flow:row wrap;align-items:center}@media (min-width:576px){.form-inline label{display:flex;align-items:center;justify-content:center;margin-bottom:0}}.btn{display:inline-block;font-weight:400;text-align:center;white-space:nowrap;vertical-align:middle;border:1px solid transparent;padding:0.46875rem 1rem;font-size:1rem;line-height:1.5;border-radius:0.25rem}.btn-primary{color:#ffffff;background-color:#2196f3;border-color:#2196f3;box-shadow:none}.dropdown{position:relative}.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:0.5rem 0;margin:0.125rem 0 0;font-size:1rem;color:#212529;text-align:left;list-style:none;background-color:#ffffff;background-clip:padding-box;border:1px solid rgba(0,0,0,0.15);border-radius:0.25rem;box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.2),0 1px 5px 0 rgba(0,0,0,0.12)}.mr-auto{margin-right:auto!important}.ml-auto{margin-left:auto!important}.btn{position:relative;padding:12px 30px;margin:0.3125rem 1px;font-size:.75rem;font-weight:400;line-height:1.428571;text-decoration:none;text-transform:uppercase;letter-spacing:0;background-color:transparent;border:0;border-radius:0.2rem;outline:0;will-change:box-shadow,transform}.btn.btn-primary{color:#fff;background-color:#9c27b0;border-color:#9c27b0;box-shadow:0 2px 2px 0 rgba(156,39,176,0.14),0 3px 1px -2px rgba(156,39,176,0.2),0 1px 5px 0 rgba(156,39,176,0.12)}.btn{color:#fff;background-color:#999999;border-color:#999999;box-shadow:0 2px 2px 0 rgba(153,153,153,0.14),0 3px 1px -2px rgba(153,153,153,0.2),0 1px 5px 0 rgba(153,153,153,0.12)}a{color:#9c27b0}label{font-size:14px;line-height:1.42857;color:#AAAAAA;font-weight:400}@media all and (max-width:375px){.page-header{height:calc(100vh + 270px)}}form{margin-bottom:1.125rem}.navbar form{margin-bottom:0}.navbar form .btn{margin-bottom:0}.checkbox label{color:#999999}label{line-height:1.1}label{color:#AAAAAA}.checkbox label{line-height:1.5}.checkbox label,label{font-size:0.875rem}.navbar .btn{margin-top:0;margin-bottom:0}.dropdown-menu li>a{position:relative;width:auto;display:flex;flex-flow:nowrap;align-items:center;color:#333;font-weight:normal;text-decoration:none;font-size:.8125rem;border-radius:0.125rem;margin:0 0.3125rem;min-width:7rem;padding:0.625rem 1.25rem;overflow:hidden;line-height:1.428571;text-overflow:ellipsis;word-wrap:break-word}@media (min-width:768px){.dropdown-menu li>a{padding-right:1.5rem;padding-left:1.5rem}}.page-header{height:100vh;background-position:center center;background-size:cover;margin:0;padding:0;border:0;display:flex;align-items:center}.page-header>.container{color:#fff}.header-filter{position:relative}.header-filter:before,.header-filter:after{position:absolute;z-index:1;width:100%;height:100%;display:block;left:0;top:0;content:""}.header-filter::before{background:rgba(0,0,0,0.5)}.header-filter .container{z-index:2;position:relative}@media all and (max-width:991px){.navbar .dropdown .dropdown-menu{border:0;padding-bottom:15px;-webkit-box-shadow:none;box-shadow:none;transform:none!important;width:auto;margin-bottom:15px;padding-top:0;height:300px;animation:none;opacity:1;overflow-y:scroll}}

	</style>

</head>
<body>
	<nav class="main-header navbar navbar-color-on-scroll fixed-top">
				<div class="main-nav-left" style="max-height:50px;">
					<!-- Begin logo position -->
						<?php if ($this->countModules('logo')) : ?>
									<jdoc:include type="modules" name="logo" style="none" />
						<?php endif; ?>
					<!-- End logo position -->
				</div>



				<div class="main-nav-right">
					<!-- Begin header-menu position -->
					<div style="text-allign:center;">



					<!--
										<button href="#ml-stack-nav-1" class="ml-stack-nav-toggle navbar-toggler toggled" type="button" aria-controls="ml-stack-nav-1">
										              <span class="navbar-toggler-icon"></span>
										              <span class="navbar-toggler-icon"></span>
										              <span class="navbar-toggler-icon"></span>
										            <div></div></button>
					-->
											<a href="#ml-stack-nav-1" class="ml-stack-nav-toggle" style="float:right;" aria-controls="ml-stack-nav-1" title="Toggle the navigation">
												<span class="ml-stack-nav-toggle__line">
												</span>
												<span class="ml-stack-nav-toggle__line">
												</span>
												<span class="ml-stack-nav-toggle__line">
												</span>
											</a>


										<!-- Begin header-menu-button position -->
											<?php if ($this->countModules('header-menu-button')) : ?>
														<jdoc:include type="modules" name="header-menu-button" style="none" />
											<?php endif; ?>
										<!-- End header-menu-button position -->

										<div style="float:right">

										<?php if ($this->countModules('header-menu')) : ?>



													<jdoc:include type="modules" name="header-menu" style="nav" />

										<?php endif; ?>
										</div>

					<!-- End header-menu position -->
				</div>
				</div>
				<div class="main-nav-middle">
					<!-- Begin suche position -->
						<?php if ($this->countModules('suche')) : ?>
									<jdoc:include type="modules" name="suche" style="none" />
						<?php endif; ?>
					<!-- End suche position -->
				</div>
	</nav>

<style> <!-- content style -->
.fabrikElementReadOnly {
		margin: 0;
}

.row-fluid.fabrikElementContainer {
	padding: 0!important;
}

/** from material  kit **/


.main-raised {
  margin-top: -60px;
  border-radius: 6px;
  box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

</style>

	<div style="height:70px;width:100%;"> </div>


		<!-- start content-header position -->
		<?php if ($this->countModules('content-header')) : ?>



					<jdoc:include type="modules" name="content-header" style="none" />



	<?php endif; ?>

	<!-- <link rel="stylesheet" href="templates/maxis-template/css/above-the-fold-content.css"> -->

	<style>
	.main.main-raised {
	  z-index:99;
		margin-left:1em;
		margin-right:1em;
	}

	</style>

	<main id="content" role="main" class="main main-raised <?php echo $span; ?>">
		<!-- Begin Content -->
		<jdoc:include type="modules" name="position-3" style="xhtml" />
		<jdoc:include type="message" />
		<jdoc:include type="component" />
		<div class="clearfix"></div>
		<jdoc:include type="modules" name="position-2" style="none" />
		<!-- End Content -->
	</main>

<head>
	<jdoc:include type="head" />

	<link rel="stylesheet" href="/templates/maxis-template/special-menu/ml-stack-nav.css">
	<link rel="stylesheet" href="/templates/maxis-template/special-menu/ml-stack-nav-theme.css">
	<link rel="stylesheet" href="/templates/maxis-template/css/material-kit.css">
	<link rel="stylesheet" href="/templates/maxis-template/special-menu/popup-menu.css">
	<link rel="stylesheet" href="templates/maxis-template/css/custom.css">



</head>


	<!-- Begin spec-menu position -->
 		<?php if ($this->countModules('spec-menu')) : ?>
 				  <jdoc:include type="modules" name="spec-menu" style="" />
 		<?php endif; ?>
 	<!-- End spec-menu position -->

<div class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
	<!-- Body -->




	<div class="body" id="top">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header-content" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
						<?php endif; ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />
					</div>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<div class="navbar pull-left">
						<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="element-invisible"><?php echo JTEXT::_('TPL_PROTOSTAR_TOGGLE_MENU'); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
					<div class="nav-collapse">
						<jdoc:include type="modules" name="position-1" style="none" />
					</div>
				</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($position8ModuleCount) : ?>
					<!-- Begin Sidebar -->
					<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="position-8" style="xhtml" />
						</div>
					</div>
					<!-- End Sidebar -->
				<?php endif; ?>

				<?php if ($position7ModuleCount) : ?>
					<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</div>


<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="/templates/maxis-template/special-menu/ml-stack-nav.js"></script>

<script src="/templates/maxis-template/js/bootstrap-material-design.min.js"></script>

<script>
    $("html").removeClass("no-js");
    $(".js-ml-stack-nav").mlStackNav();
</script>


</body>
</html>
