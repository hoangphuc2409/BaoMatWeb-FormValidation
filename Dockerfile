FROM php:8.2-fpm

# Cài đặt các phần mở rộng cần thiết
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cài đặt bất kỳ phụ thuộc nào khác bạn cần