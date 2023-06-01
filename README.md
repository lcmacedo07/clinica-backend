
# Setup Docker Para Projetos Laravel 9 com PHP 8

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/lcmacedo07/overdrive
```

```sh
cd overdrive/
```

Crie o Arquivo .env
```sh
cd overdrive/
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=overdrive
APP_URL=http://localhost:8955

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=overdrive
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

L5_SWAGGER_GENERATE_ALWAYS=true
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Acessar a documentação do Swagger
```sh
http://localhost:8955/api/documentation
```

Acesse o projeto
[http://localhost:8955](http://localhost:8955)
