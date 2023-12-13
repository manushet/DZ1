FROM mysql:8.1.0

WORKDIR /app

ADD my.cnf /etc/mysql/my.cnf

RUN chown -R mysql:root /var/lib/mysql/

EXPOSE 3306