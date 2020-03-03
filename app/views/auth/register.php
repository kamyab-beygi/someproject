{% extends 'templates/defualt.php' %}



{% block title %} register {% endblock %}

{%  block content %}
		<div>
			 {% if errors is not empty  %}
				{% for error in errors %}
					<li>{{ error }}</li>
				{%  endfor %}
			{% endif %} 
		</div>
	<form method="post" action="{{  urlFor('register.post') }}">
		
		<div>
			<label>email</label>
			<input type="email" name="email">
		</div>
		<div>
			<label>username</label>
			<input type="text" name="username">
		</div>
		<div>
			<label>password</label>
			<input type="password" name="password">
		</div>
		<div>
			<label>Passwrod_confirm</label>
			<input type="password" name="password_confirm">
		</div>
		<div>
			<input type="submit" value="Register ! ">
		</div>
	</form>
{% endblock %}