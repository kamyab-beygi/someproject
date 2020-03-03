{% extends 'templates/defualt.php' %}



{% block title %} Login {% endblock %}

{%  block content %}
	<div>
		{% if errors is not empty %}		
			{% for error in errors %}	
				<li>{{ error }}</li>
			{% endfor %}
		{% endif %}
	</div>


	<form method="post" action="{{urlFor('login.post')}}">
		<div>
			<input type="text" name="identifier" placeholder="Enter username or Email">
		</div>
		<div>
			<input type="password" name="password" placeholder="Enter Password">
		</div>
		<div>
			<input type="submit" value="signin!">
		</div>
		<input type="hidden" name="{{ csrf_key  }}" value="{{ csrf_token  }}">
	</form>
{% endblock %}