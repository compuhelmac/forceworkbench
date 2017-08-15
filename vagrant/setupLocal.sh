#!/usr/bin/env bash
echo "==> Installing mysql"
sudo apt-get install -y debconf-utils
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo apt-get install -y mysql-server

echo "==> Installing apache"
sudo apt-get install -y apache2

echo "==> Installing python"
sudo apt-get install -y python-software-properties

echo "==> Installing php5.6"
sudo apt-get install python-software-properties software-properties-common
sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php5.6
sudo apt-get install -y build-essential libxml2-dev libfuse-dev libcurl4-openssl-dev
sudo apt-get install -y build-essential libfuse-dev libcurl4-openssl-dev libxml2-dev mime-support automake libtool
sudo apt-get install -y php5.6-fpm
sudo apt-get install -y php5.6-gd
sudo apt-get install -y php5.6-mysql
sudo apt-get install -y imagemagick
sudo apt-get install -y php5.6-imagick
sudo apt-get install -y php5.6-curl
sudo apt-get install -y php5.6-xml
sudo apt-get install -y php5.6-dom
sudo apt-get install -y php5.6-redis
sudo apt-get install -y php5.6-soap
sudo apt-get install -y zip unzip php5.6-zip

echo "==> Installing git"
sudo apt-get install -y git

echo "==> setting up local"
sudo a2enmod ssl
sudo a2enmod rewrite
sudo a2enmod headers
sudo a2enmod allowmethods
sudo a2enmod authz_groupfile
sudo a2enmod cgi
sudo a2enmod proxy
sudo a2enmod proxy_balancer
sudo a2enmod proxy_fcgi
sudo a2enmod proxy_http
sudo a2enmod proxy_wstunnel
sudo a2enmod include
sudo a2enmod env

echo "==> Installing Java"
sudo apt-get install -y python-software-properties
sudo add-apt-repository ppa:webupd8team/java
sudo apt-get update
sudo debconf-set-selections <<< 'debconf shared/accepted-oracle-license-v1-1 select true'
sudo debconf-set-selections <<< 'debconf shared/accepted-oracle-license-v1-1 seen true'
sudo apt-get install -y oracle-java8-installer

sudo cp /var/www/html/forceworkbench/vagrant/forceworkbench.conf /etc/apache2/sites-available/forceworkbench.conf
sudo a2ensite forceworkbench.conf
sudo /etc/init.d/apache2 reload
