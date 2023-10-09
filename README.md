## Заметки (тестовое задание)

### Запуск проекта
- Перейдите в терминал вашей операционной системы и склонируйте проект на локальный компьютер:
```console
git clone git@github.com:rushev84/notes_pal.git
```

- Перейдите в папку с проектом и переименуйте файл `.env.example` в `.env`

#### Замените в файле .env строки 

<pre>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
</pre>

на 

<pre>
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=notes_pal
DB_USERNAME=root
DB_PASSWORD=root
</pre>

- Перейдите в папку с проектом и поднимите докер-контейнеры:
```console
docker-compose up -d
```
- Зайдите в контейнер приложения:
```console
docker exec -it notes_pal_app bash
```
- Установите зависимости:
```console
composer install
```
- Откройте доступ к папке storage:
```console
chmod 777 -R storage
```

- Сгенерируйте ключ приложения
```console
php artisan key:generate
```


- Накатите миграции:
```console
php artisan migrate
```

- Приложение доступно по адресу http://localhost:8876/

- Перейдите на страницу регистрации http://localhost:8876/register и зарегистрируйте нового пользователя

- Авторизуйтесь, введя email и пароль

### Готово!
Теперь вы можете создавать свои заметки, редактировать и удалять их.

#### Для опускания контейнера используйте команду:
```console
docker-compose down
```
