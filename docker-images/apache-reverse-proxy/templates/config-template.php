<?php
	$static_app1 = getenv('STATIC_APP1');
	$static_app2 = getenv('STATIC_APP2');
	$static_app3 = getenv('STATIC_APP3');
	$dynamic_app1 = getenv('DYNAMIC_APP1');
	$dynamic_app2 = getenv('DYNAMIC_APP2');
	$dynamic_app3 = getenv('DYNAMIC_APP3');
?>
<VirtualHost *:80>
        ServerName demo.res.ch
		
		<Proxy balancer://mysetdynamic>
			BalancerMember 'http://<?php print "$dynamic_app1"?>'
			BalancerMember 'http://<?php print "$dynamic_app2"?>'
			BalancerMember 'http://<?php print "$dynamic_app3"?>'
		</Proxy>
		
		Header add Set-Cookie "ROUTEID=.%{BALANCER_WORKER_ROUTE}e; path=/" env=BALANCER_ROUTE_CHANGED
		<Proxy balancer://mysetstatic>
			BalancerMember 'http://<?php print "$static_app1"?>' route=staticNode1
			BalancerMember 'http://<?php print "$static_app2"?>' route=staticNode2
			BalancerMember 'http://<?php print "$static_app3"?>' route=staticNode3
			ProxySet stickysession=ROUTEID
		</Proxy>
		
		<Location /balancer-manager>
			SetHandler balancer-manager
		</Location>
		ProxyPass '/balancer-manager' '!'

        ProxyPass '/api/' 'balancer://mysetdynamic/'
        ProxyPassReverse '/api/' 'balancer://mysetdynamic/'

        ProxyPass '/' 'balancer://mysetstatic/'
        ProxyPassReverse '/' 'balancer://mysetstatic/'
		
		
</VirtualHost>
