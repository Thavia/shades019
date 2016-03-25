#!/bin/bash

## Provisiona a plataforma no Ubuntu 14.04 + PHP 5.6 + Apache + MySQL + MongoDB + nodejs

echo ">>> Cria SWAP"
sudo dd if=/dev/zero of=/swapfile bs=1024 count=512k
sudo mkswap /swapfile
sudo swapon /swapfile
sudo echo "/swapfile       none    swap    sw      0       0 " >> /etc/fstab
sudo chown vagrant:vagrant /swapfile
sudo chmod 0600 /swapfile

# Define diretivas que permitirão instalar MySQL sem perguntar senha
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

# Define diretiva que permitirá atualizar o grub sem ter que selecionar qual a partição de instalação (o ubuntu 14.04 atualiza o grub sozinho ao rodar 'upgrade')
# mais info>: https://github.com/mitchellh/vagrant/issues/289
echo "set grub-pc/install_devices /dev/sda" | debconf-communicate
sudo apt-get -y -qq update
sudo apt-get -y -qq upgrade

# Instala pacotes base
sudo apt-get install -y vim curl wget git-core \
make build-essential g++ \
python-software-properties \
xclip \
xvfb wkhtmltopdf

# Adiciona repositório PPA do PHP 5.6
#sudo add-apt-repository -y ppa:ondrej/php5 #php 5.5
sudo add-apt-repository -y ppa:ondrej/php5-5.6

# Atualiza lista de pacotes
sudo apt-get update

# Timezone do sistema
sudo cp -p /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime
echo "America/Sao_Paulo" | sudo tee /etc/timezone

# Locale do sistema
echo -e "en_US.UTF-8 UTF-8\npt_BR ISO-8859-1\npt_BR.UTF-8 UTF-8" | sudo tee /var/lib/locales/supported.d/local
sudo dpkg-reconfigure locales

# instala o suporte a NFS (sem ele o Vagrant fica uma carroça)
# Notas:
# - para usarmos Vagrant com NFS é necessário que tanto host quanto guest tenham suporte instalado.
# - no host, rode: sudo apt-get install nfs-common nfs-kernel-server portmap (note o nfs-common nfs-kernel-server que o guest não tem)
# - embora tenha colocado o pacote 'portmap', o apt-get instalou o pacote 'rpcbind' em seu lugar.
# NÃO É NECESSÁRIO RODAR O COMANDO A SEGUIR PARA IMAGEM QUE ESTAMOS USANDO DO UBUNTU 14.04
#sudo apt-get install nfs-common portmap -y


# Instalando AMP (apache + mysql + php)
sudo apt-get install -y \
php5 \
php5-cli \
apache2 \
libapache2-mod-php5 \
php5-mysql \
php5-curl \
php5-gd \
php5-imagick \
php5-mcrypt \
php5-xdebug \
mysql-server \
mysql-client \
php5-cli \
php5-dev \
php-pear \
php5-intl \
php5-json \
php5-imap \
php5-readline \
openssl \
ssl-cert --force-yes

sudo service apache2 restart

sudo apt-get remove node -y
sudo ln -s /usr/bin/nodejs /usr/bin/node

# NodeJS Install e Config
sudo apt-get install node npm -y
sudo npm install -g less@1.* # da pau na nova versão instalada com 'sudo npm install less -g'
sudo npm install uglify-js -g
sudo npm install uglifycss -g
sudo npm install bower -g

# XDebug Config
cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=0
xdebug.cli_color=1
xdebug.show_local_vars=1
xdebug.max_nesting_level=250
EOF

# PHP Config

# Exiba todos os erros
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/cli/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/cli/php.ini

# Aumenta a quantidade limite de memória
sudo sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php5/apache2/php.ini
sudo sed -i "s/memory_limit = .*/memory_limit = -1/" /etc/php5/cli/php.ini

# Aumenta o tempo máximo de execução de cada script
sudo sed -i "s/max_execution_time = .*/max_execution_time = 120/" /etc/php5/apache2/php.ini
sudo sed -i "s/max_execution_time = .*/max_execution_time = 120/" /etc/php5/cli/php.ini

# Não expoe a versão do PHP no header da response.
sudo sed -i "s/expose_php = .*/expose_php = Off/" /etc/php5/apache2/php.ini
sudo sed -i "s/expose_php = .*/expose_php = Off/" /etc/php5/cli/php.ini

# tempo que o servidor guarda os dados da sessão antes de enviar para o Garbage Collection
sudo sed -i "s/session.cookie_lifetime = .*/session.cookie_lifetime = 172800/" /etc/php5/apache2/php.ini # 2 dias em segundos
sudo sed -i "s/session.cookie_lifetime = .*/session.cookie_lifetime = 172800/" /etc/php5/cli/php.ini # 2 dias em segundos

# tempo de expiração do cookie PHPSSESIONID
sudo sed -i "s/gc_maxlifetime = .*/gc_maxlifetime = 172800/" /etc/php5/apache2/php.ini # 2 dias em segundos
sudo sed -i "s/gc_maxlifetime = .*/gc_maxlifetime = 172800/" /etc/php5/cli/php.ini # 2 dias em segundos

# TIMEZONE == O -r a baixo é pro sed aceitar ?: http://stackoverflow.com/questions/6156259/sed-expression-dont-allow-optional-grouped-string
sudo sed -r -i "s,;?date.timezone =.*,date.timezone = America/Sao_Paulo" /etc/php5/apache2/php.ini
sudo sed -r -i "s,;?date.timezone =.*,date.timezone = America/Sao_Paulo" /etc/php5/cli/php.ini

# Habilita short open tags (<? ?>)
sudo sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php5/apache2/php.ini
sudo sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php5/cli/php.ini

# Aumenta o tamanho máximo dos uploads para 100MB
sudo sed -i "s/post_max_size = .*/post_max_size = 100M/" /etc/php5/apache2/php.ini # 2 dias em segundos
sudo sed -i "s/post_max_size = .*/post_max_size = 100M/" /etc/php5/cli/php.ini # 2 dias em segundos
sudo sed -i "s/upload_max_filesize = .*/upload_max_filesize = 100M/" /etc/php5/apache2/php.ini # 2 dias em segundos
sudo sed -i "s/upload_max_filesize = .*/upload_max_filesize = 100M/" /etc/php5/cli/php.ini # 2 dias em segundos

# Opcache - configs recomendadas pelo manual do PHP: http://php.net/manual/en/opcache.installation.php
cat << EOF | sudo tee -a /etc/php5/mods-available/opcache.ini
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
opcache.fast_shutdown=1
opcache.enable_cli=0
opcache.enable=0
EOF

# Desabilita xdebug no PHP Cli (melhora velocidade composer/cache:clear)
sudo php5dismod -s cli xdebug

# MySQL Config
sudo sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/my.cnf
mysql --password=root -u root --execute="GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION; FLUSH PRIVILEGES;"
mysql --password=root -u root --execute="GRANT ALL PRIVILEGES ON *.* TO 'ws'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION; FLUSH PRIVILEGES;"
service mysql restart


cat << EOF | tee -a /home/vagrant/.my.cnf
[client]
user=root
password=root
[mysqldump]
user=root
password=root
EOF
chmod 0600 /home/vagrant/.my.cnf

# Apache config
echo -e "\n# configuracoes personalizadas\nServerTokens ProductOnly\nServerSignature Off" | sudo tee -a /etc/apache2/apache2.conf
sudo sed -i 's/User ${APACHE_RUN_USER}/User vagrant/g' /etc/apache2/apache2.conf
sudo sed -i 's/Group ${APACHE_RUN_GROUP}/Group vagrant/g' /etc/apache2/apache2.conf
sudo a2enmod rewrite
sudo a2enmod ssl
sudo a2dissite 000-default
sudo a2dissite default
#sudo cp -f /vagrant/vagrant/config/apache/apache2.conf /etc/apache2/apache2.conf
#sudo cp -f /vagrant/vagrant/config/apache/ports.conf /etc/apache2/ports.conf
sudo cp -f /vagrant/config/site.conf /etc/apache2/sites-available/site.conf
sudo mkdir -p /etc/apache2/ssl/
sudo a2ensite site
sudo service apache2 restart


# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer



echo ">>> Configurando diretórios da aplicação"

if [ ! -s /var/www/site ] ; then
    sudo ln -sf /vagrant/site /var/www/site
fi

#sudo chown vagrant.vagrant /vagrant -R


sudo service apache2 restart


# Ao efetuar login (vagrant ssh), já entra no diretório '/vagrant'
echo "cd /vagrant" | sudo tee -a /home/vagrant/.bashrc
