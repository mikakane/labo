init: 
	echo "hoge"
server:
	php -S localhost:8000 -t public
docserver:
	php -S localhost:9000 -t apidoc
apigen:
	apigen generate -s ./modules/auth/src -s ./modules/app/src -d ./apidoc --template-theme=bootstrap