FROM nginx:latest

ADD vhost.conf /etc/nginx/conf.d/default.conf

EXPOSE 80 443
