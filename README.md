Установка на локальный сервер.
==============================

* Создать `config/autoload/local.php` из `config/autoload/local.dist.php`
* Добавить `config/autoload/local.php` в git:ignore (если ещё не добавлен)

* Создать базу данных и прописать доступ к ней в `config/autoload/local.php`
* Сгенерировать схему бд или накатить последний backup базы
* Прописать `base_path` в `config/autoload/local.php`

Установка на хостинг.
---------------------

* Папка public - основная директория сервера. Остальные на уровень выше.
* .htaccess APLICATION_ENV меняется на production


Обновление зависимостей
-----------------------
Скачать менеджер зависимостей

Для Linux

    curl -s https://getcomposer.org/installer | php --

Для Windows https://getcomposer.org/download/

Обновить зависимости (на сервере обновлять с параметром `--no-dev`)

    php composer.phar update
    php composer.phar update --no-dev


Обновлениее менеджера зависимостей

    php composer.phar self-update


Генерация/обновление схемы базы данных
--------------------------------------

В файле `data/Readme.md` описаны основные команды для doctrine 2

Настройка Веб сервера
---------------------

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName zf2-tutorial.localhost
        DocumentRoot /path/to/zf2-tutorial/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/zf2-tutorial/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>

Если Apache настроен на директорию `public`, то `base_path` = `/`,
в остальных случаях в `base_path` следует указать путь от `DocumentRoot`
в настройках apache до папки `public`