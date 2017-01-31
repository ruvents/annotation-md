Возможности
------------

* **Phpdoc** — Документация оформляется в виде коментариев phpdoc. Из которых генерируется .md файл.

* **Slate docker** — Формат сгенерированного .md поддерживается <a href="https://github.com/lord/slate">slate</a>

Установка
------------

`composer require nastradamus39/annotation-md`

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
 - **ApiAction** — Действие контроллера. Подраздел раздела в документации.
 - **ApiContent** — Произвольный блок контента. В документации представляет собой раздел.
 - **Request** - Описывает запрос.
 - **Param** - Параметр запроса.

```php
/**
 * @ApiController(
 *     title="Пользователь",
 *     description=""
 * )
 * @ApiContent(
 *     title="Авторизация",
 *     description="Изучение восстанавливает подзол. Новообразование качественно перемещает бур. В случае смены водного режима эрозия
вымывает в краснозём.Можно думать, что кротовина приводит к появлению журавчик. Почва, как того требуют законы термодинамики,
изотермично притягивает подзол. Выходная кривая горизонтально поглощает ион-селективный процесс."
 *  )
 */
class User
{
    /**
      * @ApiAction(
      *     title="Список пользователей",
      *     description="Возвращает список пользователей",
      *     request=@Request(
      *          method="GET",
      *          url="/users",
      *          body="",
      *          params={
      *              @Param(title="param1", type="type1", defaultValue="val", description="descr"),
      *              @Param(title="param1", type="type1", defaultValue="val", description="descr")
      *          }
      *     )
      * )
      */
     public function listAction() {}
}
``` 