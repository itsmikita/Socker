<!doctype html>
<html {{ language_attributes }}>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>{{{ title }}}</title>
		
		{{# styles }}
		<link rel="stylesheet" href="{{ . }}">
		{{/ styles }}
		
		{{# scripts }}
		<script src="{{ . }}"></script>
		{{/ scripts }}
		
		{{{ head }}}
	</head>
	<body {{ body_class }}>
		<h1>Hello!</h1>
		<p>I'm Toolbox.php.</p>
		
		{{{ footer }}}
	</body>
</html>
	
	
	