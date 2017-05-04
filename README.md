Возможности
------------

* **Phpdoc** — Документация оформляется в виде коментариев phpdoc. Из которых генерируется .md файл.

* **Slate docker** — Формат сгенерированного .md поддерживается <a href="https://github.com/lord/slate">slate</a>

Установка
------------

`composer require ruvents/annotation-md`

Использование
-------------

```php
$controllersPath = PATH_TO_CONTROLLERS;
$buildPath = BUILD_PATH;

$params = [
            "title"     => "Заголовок",
            "baseUrl"   => "http://api.yoursite.com"
        ];

$parser = new Parser($controllersPath, $buildPath, $params);
$parser->parse();
```

* **$controllersPath** - Путь к папке, в которой будет происходить поиск контроллеров.
* **$buildPath** - Путь к папке где будет сохранен постронный .md

Аннотации
-------------
Поддерживаемые аннотации:

 - **ApiController** — Описывает контроллер. Раздел в документации.
 - **ApiContent** — Произвольный блок контента. В документации представляет собой раздел.
 - **ApiError** — Блок с описанием ошибок. Добавляется в конце документации.
 - **ApiAction** — Действие контроллера. Подраздел раздела в документации.
 - **Sample** - Пример кода на одном из языков - javascript, php, shell, ruby, python
 - **Request** - Описывает запрос.
 - **Param** - Параметр запроса.

Вкладка json используется примера ответа сервера на запрос.

```php
/**
 * @ApiController(
 *     title="Пользователь",
 *     description="Описаие методов для работы с пользователем"
 * )
 * @ApiContent(
 *     title="Авторизация",
 *     description="Описание процесса авторизации"
 *  )
 * @ApiError(code="400", description="Bad Request – Your request sucks.")
 * @ApiError(code="401", description="Unauthorized – Your API key is wrong.")
 */
class User
{
    /**
      * @ApiAction(
      *     title="Список пользователей",
      *     description="Возвращает список пользователей",
      *     samples={
      *          @Sample(lang="javascript", code="alert('123');"),
      *          @Sample(lang="php", code="phpinfo();")
      *     }
      *     request=@Request(
      *          method="GET",
      *          url="/users",
      *          body="",
      *          params={
      *              @Param(title="param1", type="type1", defaultValue="val", description="descr"),
      *              @Param(title="param1", type="type1", defaultValue="val", description="descr")
      *          }
      *         response=@Response(body="json encoded array")
      *     )
      * )
      */
     public function listAction() {}
}
``` 