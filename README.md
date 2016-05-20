# Status Monitor
A very simple status monitor for UNIX systems.

## Install
```
git clone https://github.com/adhamu/status.git
cd status
composer install
npm install
bower install
gulp install
```

## Web services
Pings web endpoints to check HTTP response headers.

## Server services
Check the prescence of a pid file to check if status is running.

## Config
All config for endpoints and services are held in a config.json file. There is a sample file in this repository.

### Sample
```
{
    "web": [{
        "name": "Google",
        "url": "https://www.google.co.uk"
    }, {
        "name": "Apple",
        "url": "http://www.apple.com/uk"
    }],
    "server": [{
        "name": "Apache",
        "service": "httpd",
        "pid": "/var/run/httpd/httpd.pid"
    }, {
        "name": "MySQL",
        "service": "mysqld",
        "pid": "/var/run/mysqld/mysqld.pid"
    }]
}
```
