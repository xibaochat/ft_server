## DOKCER BUILD

FROM debian:buster

#########
# BASICS
RUN apt update && apt dist-upgrade -yy

########
# NGINX
RUN	apt install nginx openssl -yy

# nginx vhost conf
COPY ./srcs/nginx/both-websites.conf /etc/nginx/sites-available/both-websites.conf
RUN ln -s /etc/nginx/sites-available/both-websites.conf  /etc/nginx/sites-enabled/

# Generate SSL Certificate
COPY ./srcs/nginx/cert_infos.txt /root

RUN	mkdir /etc/nginx/ssl && \
	openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
	-keyout /etc/nginx/ssl/nginx.key \
	-out /etc/nginx/ssl/nginx.crt < /root/cert_infos.txt
RUN rm -f /root/cert_infos.txt

#######
# MySQL
RUN apt install mariadb-server -yy


############
# WORDPRESS
# Install wordpress dependencues
RUN apt install -yy php-fpm php-common php-mbstring php-xmlrpc php-soap php-gd php-xml php-intl php-mysql php-cli php-ldap php-zip php-curl wget

# Database
COPY srcs/wordpress/wordpress_database.sql /root/wordpress_database.sql
RUN /etc/init.d/mysql start && mysql <  /root/wordpress_database.sql
RUN rm -f /root/wordpress_database.sql

COPY srcs/wordpress/wordpress_tables.sql /root/wordpress_tables.sql
RUN /etc/init.d/mysql start && mysql < /root/wordpress_tables.sql
RUN rm -f /root/wordpress_tables.sql

# Install source code wordpress
COPY srcs/wordpress/source_code /var/www/html/wordpress
RUN chown www-data: /var/www/html/wordpress/ -R

#############
# PHPMYADMIN
RUN mkdir -p /var/lib/phpmyadmin/tmp && \
	chown -R www-data:www-data /var/lib/phpmyadmin

COPY ./srcs/phpmyadmin/srcs /var/www/html/phpmyadmin

COPY srcs/phpmyadmin/create_database_phpmyadmin.sql /root/create_database_phpmyadmin.sql
RUN /etc/init.d/mysql start && mysql < /root/create_database_phpmyadmin.sql
RUN rm -f /root/create_database_phpmyadmin.sql

COPY srcs/phpmyadmin/backup_phpmyadmin.sql /root/backup_phpmyadmin.sql
RUN /etc/init.d/mysql start && mysql < /root/backup_phpmyadmin.sql
RUN rm -f /root/backup_phpmyadmin.sql

### DOCKER RUN
CMD /etc/init.d/nginx start && \
	/etc/init.d/mysql start && \
	/etc/init.d/php7.3-fpm start && \
	tail -f /var/log/nginx/access.log
