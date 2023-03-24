Миграция настроек
----
```
yii migrate/up --migrationPath=@vendor/pheme/yii2-settings/migrations
```

Запуск docker-compose
----
```
docker-compose up -d --build
```

онлайн проектирование БД
https://ondras.zarovi.cz/sql/demo/

Примечание 
----
1. В модуле **Instagram** добавить возможность выйти из аккаунта. 
2. Таблицу **Luis** переделать +

3. Переделать таблицу InstagramDirect 
4. Переделать Класс common\components\server\RealtimeClientServer
 Передать id проекта + (проверить) нужно ли передавать id_instagrama
5. Переделать Класс console\controllers\console\controllers передать параметры из консоли  
id_project + id_instagram



