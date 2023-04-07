FROM php:8.2.3-apache as apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo_mysql

# Install OpenSSL and generate a self-signed SSL certificate
RUN apt-get update && \
    apt-get install -y openssl git unzip p7zip-full && \
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/private/server.key \
    -out /etc/ssl/certs/server.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

# Enable the SSL and htaccess rewrite modules in Apache
RUN a2enmod ssl
RUN a2enmod rewrite



# Generate the virtual host configuration file
RUN echo "<VirtualHost *:80>\n\
    ServerName localhost\n\
    DocumentRoot /var/www/html\n\
    </VirtualHost>\n\
    <VirtualHost *:443>\n\
    ServerName localhost\n\
    DocumentRoot /var/www/html\n\
    SSLEngine on\n\
    SSLCertificateFile /etc/ssl/certs/server.crt\n\
    SSLCertificateKeyFile /etc/ssl/private/server.key\n\
    </VirtualHost>" > /etc/apache2/sites-enabled/000-default.conf


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

