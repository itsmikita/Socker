<!DOCTYPE html>
<html>

<head>
<meta charset="utf8" />
<title>jQuery Paperfold</title>
<style type="text/css">
	@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,200italic,400italic,700italic|Lato:300|Droid+Sans+Mono|Oxygen);
	
	* {
		margin: 0;
		padding: 0;
	}
	
	body {
		font-family: 'Oxygen', sans-serif;
		background: #fafafb;
		margin: 40px 0;
	}
	
	h1, .h1 {
		font: 300 36px/40px 'Lato', serif;
		margin-bottom: 40px;
	}
	h2 {
		font: bold 14px/14px 'Source Sans Pro', sans-serif;
		margin-bottom: 14px;
		text-transform: uppercase;
	}
	p, li {
		font-size: 18px;
		margin-bottom: 12px;
	}
	p.intro { font-size: 18px; }
	li {
		margin-left: 30px;
	}
	pre, code {
		font: normal 12px/16px 'Droid Sans Mono', monospace;
	}
	pre { margin: 8px 0; }
	
	input[type=submit], .button {
		background: #1c7cd9;
		background: -webkit-linear-gradient( bottom, #1c7cd9 0%, #55a6f6 100% );
		border: 1px solid #1460aa;
		border-radius: 3px;
		box-shadow: inset 0 1px 0 #7ec1f8;
		color: white;
		cursor: pointer;
		font-family: 'Oxygen', sans-serif;
		font-size: 14px;
		text-shadow: 0 -1px 0 #256db8;
		text-transform: uppercase;
		padding: 5px 12px;
	}
	
	#wrap {
		width: 480px;
		margin: 0 auto 40px;
	}
	#body {
		background: white;
		border-radius: 4px;
		box-shadow: 0 1px 3px rgba( 0, 0, 0, 0.2 );
		padding: 40px 60px;
	}
</style>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<script src="dist/paperfold.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery( function( $ ) {
	$( '#toggle' ).click( function( e ) {
		e.preventDefault();
		
		$( '#body' ).paperfoldToggle();
		// $( '#body' ).paperfoldHide();
		// $( '#body' ).paperfoldShow();
	} );
} );
</script>
</head>
<body>

<div id="wrap">
<div id="body">
