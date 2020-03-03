<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="{{ baseUrl }}" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<title>wesite | {% block title %} {% endblock %}</title>
</head>
	<body>
		{% include 'templates/partials/messages.php' %}
		{% include 'templates/partials/nav.php' %}
		{% block content %}{% endblock %}
	</body>
</html>