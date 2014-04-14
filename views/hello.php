<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php echo $page_title; ?></title>
	
	<?php /* This is just an example of where hooks could be placed */ ?>
	<?php $app->doing( 'head' ); ?>
	
</head>
<body>
	
	<h1><?php echo $hello_world; ?></h1>
	
	<?php /* This is just an example of where hooks could be placed */ ?>
	<?php $app->doing( 'body' ); ?>
	
</body>
</html>
