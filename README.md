# Тестовое задание для PHP-разработчика
### Описание задачи

Необходимо написать web-приложение для продажи подержанных авто. (auto.ru)

Структура базы должна позволять хранить: возможные  характеристики автомобиля, объявления о продаже.

Возможные действия:

* Поиск автомобилей по фильтрам (марка, год выпуска, страна производитель,  и т. п.  - 3 любых будет достаточно)
* Просмотр конкретного объявления выбранного из списка
* Добавление/Редактирование/Удаление объявления о продаже (предположим что вы администратор и можете делать все эти действия)

Технические требования:

* Приложение должно быть написано на PHP 5.4 +
* БД MySql
* Допускается использование  фреймворка

Результат задания должен быть выложен на github или прислан в виде архива, должна быть инструкция по запуску проекта.
<hr/>

### Результат

Приложение сделано со стеком:

* PHP 5.6
* MySql 5.5
* Zend Framework v.3 Expressive
* Doctrine 2.0 ORM
* Шаблонизатор Twig.
* CSS Framework Bootstrap.

### Требования к установке для проверки

* PHP 5.6 (5.6.31)
* MySql 5.5
* Composer 1.5.2
* git 2.13.3

### Установка

1. В консоли:
```bash
$ git clone https://github.com/vladmeh/auto-sale-ads.git
$ cd auto-sale-ads
$ composer selfupdate
$ composer install
```

2. Переименовать файл `config/autoload/development.local.php.dist` в `config/autoload/development.local.php`

### База данных

* name database - auto-sale-ads
* user - root
* password - ''
* port - 3306

Для соединения переименовываем конфигурационный файл  `config/autoload/doctrine.local.php.dist` в `config/autoload/doctrine.local.php`.
Следующего содержания:
```php
<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'url' => 'mysql://root@localhost:3306/auto-sale-ads',
                ]
            ],
        ],
    ],
];
```

> Параметры (name DB, user, password, port) можно выставить свои.

после установки соединения с БД делаем проверку

```bash
$ vendor/bin/doctrine -V
Doctrine Command Line Interface 2.5.12
```

Создать таблицы в БД можно двумя способами
1. В консоли
```bash
$ vendor/bin/doctrine orm:schema-tool:update --force --dump-sql --complete
$ vendor/bin/doctrine dbal:import "data/dump.sql"
```

2. С помощью скрипта `data/script.sql`

>Общий дамп БД находиться в файле `data/dump.sql`
>Так же для каждой таблицы отдельно в `data/auto_sale_ads_[table_name].sql`

### Запуск

```bash
$ php -S localhost:8080 -t public public/index.php

PHP 5.6.31 Development Server started at Mon Nov 27 09:37:46 2017
Listening on http://localhost:8080
Document root is ~/auto-sale-ads/public
Press Ctrl-C to quit.
.....
```
