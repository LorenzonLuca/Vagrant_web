sudo apt update
sudo apt install mysql-server -y
sudo systemctl start mysql.service
sudo mysql
sudo mysql -e "CREATE USER 'admin'@'%' IDENTIFIED BY 'Password&1';"