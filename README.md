# Intersvyaz PHP workshop

## Первый запуск проекта
Собираем образы, описанные в docker-compose.yml:

```docker-compose build```

Инсталируем зависимости PHP библиотек, описанные в composer.lock:

```docker-compose run --rm --no-deps php-fpm composer install```

Запускаем миграции базы данных:

```docker-compose run --rm php-fpm ./yii migrate/up --interactive=0```


Запускаем контейнеры:

```docker-compose up -d```

Запуск обработчика очереди:

```docker-compose exec php-fpm ./yii worker/run```


Ссылка на рабочий проект: http://127.0.0.1:8000/

PHPMyAdmin: http://127.0.0.1:8080/


Запуск нагрузочного тестирования: 
```docker-compose exec php-fpm ab/run.sh```
