### Doctrine orm:schema commands

Валижация схемы

    ./vendor/bin/doctrine-module orm:validate-schema

Обновление схемы

    ./vendor/bin/doctrine-module orm:schema-tool:update --force

Конвертация схемы из базы данных

    ./vendor/doctrine/doctrine-module/bin/doctrine-module orm:convert-mapping --namespace="{ModuleName}\\Entity\\" --force  --from-database annotation ./module/{ModuleName}/src/

Создание сущностей

    ./vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./module/{ModuleName}/src/ --generate-annotations=true

Очистка базы данных

    ./vendor/bin/doctrine-module orm:schema-tool:drop --force

### SQL файлы

* файлы dump_*.sql.zip - дамп бд за * число.
* файлы sql_*.sql.zip - интекции, которые необходимо накатить на последний дамп.