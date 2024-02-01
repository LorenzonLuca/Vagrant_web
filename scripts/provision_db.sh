sudo apt update
sudo apt install mysql-server -y

sudo mysql
sudo mysql < /vagrant/db/Libreria.sql
sudo mysql -e "CREATE USER 'm340'@'10.10.20.%' IDENTIFIED BY 'Password&1';"
sudo mysql -e "GRANT ALL PRIVILEGES ON libreria.* TO 'm340'@'10.10.20.%' WITH GRANT OPTION;"

sudo sed -i "s/bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
sudo sed -i "s/mysqlx-bind-address\s*=\s*127.0.0.1/mysqlx-bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf

sudo systemctl restart mysql