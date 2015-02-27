<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php $view['slots']->output('title', 'Welcome!') ?></title>
	<?php $view['slots']->output('stylesheets') ?>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
</head>
<body id="page-top" class="index">
	<?php $view['slots']->output('_content') ?>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<?php $view['slots']->output('javascripts') ?>
</body>
</html>
