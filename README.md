## Условия задачи:
Используя laravel framework, написать REST API для выдачи текущих курсов валют (использовать для этого сторонний сервис и интегрироваться к нему через АПИ). Для работы с бд использовать ORM. Для респонсов использовать [https://laravel.com/docs/5.8/eloquent-resources](https://laravel.com/docs/5.8/eloquent-resources)

  

Выводить обязательно только две валюты USD, EUR, плюсом будет если будут все.

  

Методы:

/exchange-rates - текущие курсы валют (EUR, USD) (после каждого запроса на этот метод, сохранять текущие курсы в БД, чтобы они потом отображались в методе ниже)

  

/exchange-rates/history/ - история изменения курсов валют (из БД)

  

Запушить и описать проект на github. В описании должно быть описано как разворачивать проект.

  

Огромным плюсом будет, если проект будет упакован в докер контейнер.
## Развертывание

 1. В /monolite создать папку log с файлами frontend-access.log и frontend-error.log
 2.  Скопировать .env.example и /monolite/.env.example в .env и /monolite/.env соответственно
 3. Запустить: `docker-compose up -d --build`  в корневой директории проекта
 4. Запустить `docker exec -it facepass_php php artisan migrate:fresh`
 5. Запустить `docker exec -it facepass_php php artisan db:seed`

## Решение

 1. Пакетный менеджер для развертывания: docker-compose
 2. Фреймворк: laravel ~8.12
 3. Сторонее api для получение курсов: https://api.exchangerate.host/
 
Base url приложения: /api
Пример запроса: http://localhost/api/exchange-rates

