#!/bin/bash

pkgs="
apache2
libapache2-mod-php5
php5
php5-sqlite
sqlite3
git
"

apt-get update
apt-get upgrade
apt-get install $pkgs -y

mkdir /home/backup
mkdri /home/why
chown -R www-data:www-data /home/why
chown -R www-data:www-data /home/backup

cat <<EOF > /etc/apache2/sites-avaible
<VirtualHost *:80>
ServerAdmin webmaster@localhost

DocumentRoot /home/why/
<Directory />
Options FollowSymLinks
AllowOverride None
</Directory>
<Directory /home/why/>
Options Indexes FollowSymLinks MultiViews
AllowOverride None
Order allow,deny
allow from all
</Directory>

ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
<Directory "/usr/lib/cgi-bin">
AllowOverride None
Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
Order allow,deny
Allow from all
</Directory>

ErrorLog ${APACHE_LOG_DIR}/error.log

# Possible values include: debug, info, notice, warn, error, crit,
# alert, emerg.
LogLevel warn

CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

cat <<EOF > /etc/cron.d/daily-purge-sql
0 1 * * * www-data /usr/bin/sqlite3 /home/why/database/database.db .dump > /home/backup/why.`/bin/date '+\%Y\%m\%d-\%H:\%M:\%S'`.sql;
EOF

git clone https://github.com/Touristes/2SN.git /home/why/

chown -R www-data:www-data /home/why
chmod -R 400 /home/why
