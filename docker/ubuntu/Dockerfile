#note: problem with ubuntu 18.04, curl needs libcurl4 but php7.3-curl needs libcurl13
#and 2 different version of libcurl can not co-exists

FROM ubuntu:16.04
MAINTAINER Md Fahim Uddin <visionq9gmail.com>

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections

RUN apt-get update
RUN apt-get install -y software-properties-common
RUN apt-get install -y sudo
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C
RUN add-apt-repository "deb http://ppa.launchpad.net/ondrej/php/ubuntu xenial main"
#RUN add-apt-repository "deb http://security.ubuntu.com/ubuntu xenial-security main"

RUN apt-get update

RUN apt-get install -y apt-file
RUN apt-file update
RUN apt-get install -y curl \
    vim \
    zip \
    python-pip \
    git

RUN pip install --upgrade awscli

RUN apt-get install -y --allow-unauthenticated php7.3 \
    php7.3-bcmath \
    php7.3-mbstring \
    php7.3-curl \
    php7.3-xml \
    php7.3-zip \
    php7.3-mysql \
    php7.3-gmp \
    libicu55 \
    php7.3-intl \
    php7.3-dev

#install apache
RUN update-alternatives --set php /usr/bin/php7.3
RUN apt-get install -y rsyslog \
    apache2

COPY eventm.zit.conf /etc/apache2/sites-available/

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2dissite 000-default
RUN a2ensite eventm.zit.conf

#add user
RUN groupadd eventm
RUN useradd --create-home --shell /bin/bash  -g eventm eventm
RUN usermod -a -G sudo eventm
RUN echo '%eventm ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers
RUN newgrp sudo

#install composer
RUN cd ~
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN echo "ServerName localhost" >> /etc/apache2/httpd.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80 443

CMD ["/usr/sbin/apachectl","-D","FOREGROUND"]