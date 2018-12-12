# Status Monitor
A very simple status monitor for UNIX systems.

<img src="screenshot.png" width="540">

## Requirements
- Docker
- Composer
- Yarn

## Install
```shell
$ git clone https://github.com/adhamu/status.git
$ cd status
$ mv config.sample.json config.json
$ composer install && yarn && gulp install
$ docker-compose up -d
```

Open up [http://localhost:8888](http://localhost:8888)

## Web services
Pings web endpoints to check HTTP response headers.

Note: You can add `verify: false` to web endpoints to surpress SSL errors. (Useful when using self-signed certificates).

## Server services
Check the prescence of a pid file to check if service is running.

## Config
All config for endpoints and services are held in a config.json file. There is a sample file in this repository.

### Sample
```json
{
    "Development": {
        "web": [{
            "name": "Blog",
            "url": "http://localhost/blog"
        }, {
            "name": "PHPMyAdmin",
            "url": "http://localhost/pma"
        }],
        "server": [{
            "name": "Docker",
            "service": "docker",
            "pid": "/var/run/httpd/docker.sock"
        }]
    },
    "Production": {
        "web": [{
            "name": "Blog",
            "url": "https://amitd.co/blog"
        }],
        "server": [{
            "name": "MySQL",
            "service": "mysqld",
            "pid": "/var/run/mysqld/mysqld.pid"
        }]
    }
}
```
