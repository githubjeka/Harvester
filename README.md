Harvester
=========

Инвентаризация в сети  (INVENTAR NETWORK)

Сбор сведений о компьютерах в сети. Работает только под Windows OS.

Установка:

- Скачиваем

- Устанавливаем Yii1.x framework - http://www.yiiframework.com/download/

- Изменяем index.php, путь к фреймворку, в этой строке:
```php
$yii=dirname(__FILE__).DIRECTORY_SEPARATOR.'..\yii\yii.php';
```

- Импортируем базу `protected/data/structure.sql` и затем `protected/data/data.sql`

- Настраиваем конфиг `protected/config/main.php`:

Базу DB
```php
 'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=inventar',
            'emulatePrepare' => true,
            'username' => 'inventar',
            'password' => 'mysql',
            'charset' => 'utf8',
        ),
```
Разрешённый вход по списоку ip
```php
 'params' => array(
        'ip_access' => array(...),
    ),
```
Эти ip участвуют в проверке авторизации пользователей в контроллерах `protected/controllers/ComputersController.php`:
```php
 public function accessRules()
    {
        return array(
            array(
                //...
                'ips' => Yii::app()->params['ip_access'], //тут
```


*Есть вопросы* - пишите `new issue` - https://github.com/githubjeka/Harvester/issues
