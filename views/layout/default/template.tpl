<html>
	<head>
		<title>WIZARD FRAMEWORK</title>
		<link href="{$_layoutParams.css_route}" rel="stylesheet" type="text/css" />
		<script  src="{$_layoutParams.root}public/js/jquery.js" type="text/javascript"></script>
		<script  src="{$_layoutParams.root}public/js/jquery.validate.js" type="text/javascript"></script>
		{if isset($_layoutParams.js) && count($_layoutParams.js)}
		{foreach item=js from=$_layoutParams.js}
		<script  src="{$js}" type="text/javascript"></script>
		{/foreach}
		{/if}
	</head>
	<body>
		<div id="header">
			<h1>{$_layoutParams.config.app_name}</h1>
		</div>

		<div id="content">	
			{if isset($_error)}
			<div id="error">
				{$_error}
			</div>
			{/if}
		
			{if isset($_message)}
			<div id="message">
				{$_message}
			</div>
			{/if}

			{include file=$_content}

		</div>

		<div id="footer">
			{$_layoutParams.config.app_company}
		</div>
	</body>
</html>