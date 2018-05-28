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

        #ErrorLog ${APACHE_LOG_DIR}/error.log
        #CustomLog ${APACHE_LOG_DIR}/access.log combined
		
		<Proxy balancer://mysetdynamic>
			BalancerMember 'http://<?php print "$dynamic_app1"?>'
			BalancerMember 'http://<?php print "$dynamic_app2"?>'
			BalancerMember 'http://<?php print "$dynamic_app3"?>'
		</Proxy>
		
		<Proxy balancer://mysetstatic>
			BalancerMember 'http://<?php print "$static_app1"?>'
			BalancerMember 'http://<?php print "$static_app2"?>'
			BalancerMember 'http://<?php print "$static_app3"?>'
		</Proxy>

        ProxyPass '/api/students/' 'balancer://mysetdynamic/'
        ProxyPassReverse '/api/students/' 'balancer://mysetdynamic/'

        ProxyPass '/' 'balancer://mysetstatic/'
        ProxyPassReverse '/' 'balancer://mysetstatic/'
		
		<Location "/balancer-manager">
			SetHandler balancer-manager
			Require host demo.res.ch
		</Location>
</VirtualHost>
