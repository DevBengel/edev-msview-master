FROM centos:centos7.7.1908
Run yum install epel-release httpd mysql -y
RUN yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN yum -y install yum-utils
RUN yum-config-manager --enable remi-php70
RUN yum -y install php php-opcache php-mysqlnd
RUN yum -y install php-mysqlnd
COPY view.php /var/www/html/index.php
ENTRYPOINT ["/usr/sbin/httpd"]
CMD ["-D", "FOREGROUND"]

