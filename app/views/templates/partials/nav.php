{% if auth %}
	<p> Hello , {{ auth.getfullnameOrUsername}}</p>
{% endif %}
<ul>
	<li><a href="{{ urlFor('home') }}">home</a></li>
	{% if auth %}
		<li><a href="{{ urlFor('logout') }}">logout</a></li>
	{% else %}
	<li><a href="{{ urlFor('register') }}">register</a></li>
	<li><a href="{{ urlFor('login') }}">login</a></li>

	{% endif %}
</ul>
