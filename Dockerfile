#******************************************************************************#
#                                                                              #
#                                                         :::      ::::::::    #
#    Dockerfile                                         :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: xinwang <xinwang@student.42.fr>            +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/12/27 16:59:48 by xinwang           #+#    #+#              #
#    Updated: 2019/12/27 18:27:34 by xinwang          ###   ########.fr        #
#                                                                              #
#******************************************************************************#

FROM debian:buster
MAINTAINER xinwang@student.42.fr

RUN apt update && \
	apt dist-upgrade -yy && \
	apt install apt-utils -yy

########
# NGINX
RUN	apt install nginx -yy

#######
# MySQL
RUN apt install mariadb-server -yy

############
# WORDPRESS
# Install wordpress dependencues
RUN apt install -yy php-fpm php-common php-mbstring php-xmlrpc php-soap php-gd php-xml php-intl php-mysql php-cli php-ldap php-zip php-curl wget

# nginx vhost conf
COPY ./srcs/nginx/wordpress.conf /etc/nginx/sites-available/wordpress.conf
RUN ln -s /etc/nginx/sites-available/wordpress.conf  /etc/nginx/sites-enabled/ && \
	/etc/init.d/nginx reload

# Database
COPY srcs/wordpress/wordpress_database.sql /tmp/
COPY srcs/wordpress/wordpress_tables.sql /tmp/

RUN /etc/init.d/mysql start && \
	mysql < /tmp/wordpress_database.sql && \
	mysql < /tmp/wordpress_tables.sql

# Install source code wordpress
COPY srcs/wordpress/source_code /var/www/html/wordpress
RUN chown www-data: /var/www/html/wordpress/ -R

# Install phpmyadmin
RUN mkdir -p /var/lib/phpmyadmin/tmp && \
	chown -R www-data:www-data /var/lib/phpmyadmin

COPY ./srcs/phpmyadmin/srcs /usr/share/phpmyadmin
COPY ./srcs/phpmyadmin/create_database_phpmyadmin.sql /tmp/
COPY ./srcs/phpmyadmin/backup_phpmyadmin.sql /tmp/

RUN /etc/init.d/mysql start && \
	mysql < /tmp/create_database_phpmyadmin.sql && \
	mysql < /tmp/backup_phpmyadmin.sql
