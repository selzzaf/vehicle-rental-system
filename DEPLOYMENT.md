# Deployment Guide

This guide provides step-by-step instructions for deploying the Vehicle Rental Management System to production environments.

## 🚀 Prerequisites

Before deploying, ensure you have:

- **Server Requirements**:
  - PHP 8.1 or higher
  - Composer
  - MySQL 8.0+ or PostgreSQL 12+
  - Web server (Apache/Nginx)
  - SSL certificate (recommended)

- **Server Access**:
  - SSH access to your server
  - Database access credentials
  - Domain name configured

## 📋 Pre-Deployment Checklist

- [ ] Code is tested and working locally
- [ ] Database migrations are ready
- [ ] Environment variables are configured
- [ ] SSL certificate is installed
- [ ] Domain DNS is configured
- [ ] Backup strategy is in place

## 🛠️ Deployment Methods

### Method 1: Manual Deployment

#### 1. Server Setup

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install required packages
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip php8.1-gd php8.1-bcmath
sudo apt install nginx mysql-server composer git unzip
```

#### 2. Database Setup

```bash
# Access MySQL
sudo mysql -u root -p

# Create database and user
CREATE DATABASE vehicle_rental;
CREATE USER 'rental_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON vehicle_rental.* TO 'rental_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 3. Application Deployment

```bash
# Clone repository
cd /var/www
sudo git clone https://github.com/yourusername/vehicle-rental-system.git
sudo chown -R www-data:www-data vehicle-rental-system
cd vehicle-rental-system

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Environment setup
cp .env.example .env
php artisan key:generate
```

#### 4. Environment Configuration

Edit `.env` file:

```env
APP_NAME="Vehicle Rental System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_rental
DB_USERNAME=rental_user
DB_PASSWORD=secure_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### 5. Database Migration

```bash
# Run migrations
php artisan migrate --force

# Seed database (optional)
php artisan db:seed --force

# Create storage link
php artisan storage:link
```

#### 6. Nginx Configuration

Create `/etc/nginx/sites-available/vehicle-rental`:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com;
    
    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;
    
    root /var/www/vehicle-rental-system/public;
    index index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
    
    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
}
```

Enable the site:

```bash
sudo ln -s /etc/nginx/sites-available/vehicle-rental /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### 7. File Permissions

```bash
# Set proper permissions
sudo chown -R www-data:www-data /var/www/vehicle-rental-system
sudo chmod -R 755 /var/www/vehicle-rental-system
sudo chmod -R 775 /var/www/vehicle-rental-system/storage
sudo chmod -R 775 /var/www/vehicle-rental-system/bootstrap/cache
```

### Method 2: Using Docker

#### 1. Create Dockerfile

```dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
```

#### 2. Create docker-compose.yml

```yaml
version: '3'
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: vehicle_rental_app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
      - ./docker/php/local.ini:/usr/local/etc/php/conf.d/local.ini
    networks:
      - vehicle_rental_network

  webserver:
    image: nginx:alpine
    container_name: vehicle_rental_nginx
    restart: unless-stopped
    ports:
      - "8000:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx/conf.d/:/etc/nginx/conf.d/
    networks:
      - vehicle_rental_network

  db:
    image: mysql:8.0
    container_name: vehicle_rental_db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: vehicle_rental
      MYSQL_ROOT_PASSWORD: your_mysql_root_password
      MYSQL_PASSWORD: your_mysql_password
      MYSQL_USER: your_mysql_user
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - vehicle_rental_network

networks:
  vehicle_rental_network:
    driver: bridge

volumes:
  dbdata:
    driver: local
```

#### 3. Deploy with Docker

```bash
# Build and start containers
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate

# Seed database
docker-compose exec app php artisan db:seed

# Set permissions
docker-compose exec app chown -R www-data:www-data /var/www
```

## 🔧 Post-Deployment Configuration

### 1. Application Optimization

```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 2. Cron Jobs Setup

Add to crontab (`crontab -e`):

```bash
# Laravel scheduler
* * * * * cd /var/www/vehicle-rental-system && php artisan schedule:run >> /dev/null 2>&1

# Database backups (daily)
0 2 * * * mysqldump -u rental_user -p'secure_password' vehicle_rental > /backups/vehicle_rental_$(date +\%Y\%m\%d).sql
```

### 3. Monitoring Setup

```bash
# Install monitoring tools
sudo apt install htop iotop nethogs

# Set up log rotation
sudo nano /etc/logrotate.d/vehicle-rental
```

Log rotation configuration:

```
/var/www/vehicle-rental-system/storage/logs/*.log {
    daily
    missingok
    rotate 52
    compress
    notifempty
    create 644 www-data www-data
}
```

## 🔒 Security Configuration

### 1. Firewall Setup

```bash
# Configure UFW firewall
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

### 2. SSL Certificate

```bash
# Install Certbot for Let's Encrypt
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com
```

### 3. Security Headers

Add to Nginx configuration:

```nginx
# Security headers
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header X-Content-Type-Options "nosniff" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
```

## 📊 Performance Optimization

### 1. PHP Configuration

Edit `/etc/php/8.1/fpm/php.ini`:

```ini
memory_limit = 256M
max_execution_time = 60
upload_max_filesize = 10M
post_max_size = 10M
opcache.enable = 1
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 4000
```

### 2. Database Optimization

```sql
-- Add indexes for better performance
ALTER TABLE vehicles ADD INDEX idx_status (status);
ALTER TABLE reservations ADD INDEX idx_dates (start_date, end_date);
ALTER TABLE reservations ADD INDEX idx_status (status);
```

### 3. Caching

```bash
# Configure Redis for caching
sudo apt install redis-server

# Update .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

## 🔄 Update Deployment

### 1. Backup Before Update

```bash
# Backup database
mysqldump -u rental_user -p'secure_password' vehicle_rental > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup application files
tar -czf app_backup_$(date +%Y%m%d_%H%M%S).tar.gz /var/www/vehicle-rental-system
```

### 2. Update Application

```bash
cd /var/www/vehicle-rental-system

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize
```

## 🚨 Troubleshooting

### Common Issues

1. **Permission Errors**
   ```bash
   sudo chown -R www-data:www-data /var/www/vehicle-rental-system
   sudo chmod -R 755 /var/www/vehicle-rental-system
   ```

2. **Database Connection Issues**
   - Check database credentials in `.env`
   - Verify database server is running
   - Check firewall settings

3. **500 Server Errors**
   - Check Laravel logs: `tail -f storage/logs/laravel.log`
   - Verify file permissions
   - Check PHP error logs

4. **Image Upload Issues**
   - Verify storage directory permissions
   - Check upload_max_filesize in php.ini
   - Ensure storage link is created

### Log Locations

- **Laravel Logs**: `/var/www/vehicle-rental-system/storage/logs/`
- **Nginx Logs**: `/var/log/nginx/`
- **PHP Logs**: `/var/log/php8.1-fpm.log`
- **System Logs**: `/var/log/syslog`

## 📞 Support

For deployment issues:

1. Check the troubleshooting section
2. Review Laravel and server logs
3. Verify all prerequisites are met
4. Contact system administrator if needed

---

**Note**: This deployment guide assumes a Linux server environment. Adjust commands and paths according to your specific server setup and requirements. 