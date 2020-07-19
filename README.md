Helpers for Yii2
================
Helpers for Yii2

[![Latest Stable Version](https://poser.pugx.org/yiier/yii2-helpers/v/stable)](https://packagist.org/packages/yiier/yii2-helpers) 
[![Total Downloads](https://poser.pugx.org/yiier/yii2-helpers/downloads)](https://packagist.org/packages/yiier/yii2-helpers) 
[![Latest Unstable Version](https://poser.pugx.org/yiier/yii2-helpers/v/unstable)](https://packagist.org/packages/yiier/yii2-helpers) 
[![License](https://poser.pugx.org/yiier/yii2-helpers/license)](https://packagist.org/packages/yiier/yii2-helpers)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiier/yii2-helpers "*"
```

or add

```
"yiier/yii2-helpers": "*"
```

to the require section of your `composer.json` file.


Method Listing
-----

### arrayShift

```php
ArrayHelper::arrayShift([0 => 'a', 2 => 'c', 1 => 'b']);
// [2 => 'c', 1 => 'b']
```

### saveAll

```php
$rows = [];
foreach ($items as $key => $value) {
    $rows[$key]['title'] = $value['title'];
    $rows[$key]['user_id'] = $userId;
}
if (!ModelHelper::saveAll(Post::tableName(), $rows)) {
    throw new Exception();
}
```

### Global Functions

change `composer.json` file, add this:

```
"autoload": {
    "files": [
      "vendor/yiier/yii2-helpers/src/GlobalFunctions.php",
      "vendor/yiier/yii2-helpers/src/SupportFunctions.php"
    ]
},
```

then run

```
$ composer dump
```

### SearchModel

示例一

```php
$searchModel = new SearchModel([
    'model' => Topic::className(),
    'scenario' => 'default',
]);
$dataProvider = $searchModel->search(['SearchModel' => Yii::$app->request->queryParams]);
return $this->render('index', [
     'dataProvider' => $dataProvider,
]);
```

示例二

```php
$searchModel = new SearchModel([
    'defaultOrder' => ['id' => SORT_DESC],
    'model' => Topic::className(),
    'scenario' => 'default',
    'relations' => ['comment' => []], // 关联表（可以是Model里面的关联）
    'partialMatchAttributes' => ['title'], // 模糊查询
    'pageSize' => 15
]);
$dataProvider = $searchModel->search(['SearchModel' => Yii::$app->request->queryParams]);
$dataProvider->query->andWhere([Topic::tableName() . '.user_id' => 23, Comment::tableName() . '.status' => 1]);
return $this->render('index', [
     'dataProvider' => $dataProvider,
]);
```


### FileTarget

Can achieve results：`@app/runtime/logs/error/20151223_app.log`

change config file, main.php

```php
'components' => [
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            /**
             * 错误级别日志：当某些需要立马解决的致命问题发生的时候，调用此方法记录相关信息。
             * 使用方法：Yii::error()
             */
            [
                'class' => 'yiier\helpers\FileTarget',
                // 日志等级
                'levels' => ['error'],
                // 被收集记录的额外数据
                'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION', '_SERVER'],
                // 排除404错误
                'except' => ['yii\web\HttpException:404'],
                // 指定日志保存的文件名
                'logFile' => '@app/runtime/logs/error/app.log',
                // 是否开启日志 (@app/runtime/logs/error/20151223_app.log)
                'enableDatePrefix' => true,
            ],
            /**
             * 警告级别日志：当某些期望之外的事情发生的时候，使用该方法。
             * 使用方法：Yii::warning()
             */
            [
                'class' => 'yiier\helpers\FileTarget',
                // 日志等级
                'levels' => ['warning'],
                // 被收集记录的额外数据
                'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION', '_SERVER'],
                // 指定日志保存的文件名
                'logFile' => '@app/runtime/logs/warning/app.log',
                // 是否开启日志 (@app/runtime/logs/warning/20151223_app.log)
                'enableDatePrefix' => true,
            ],
            /**
             * info 级别日志：在某些位置记录一些比较有用的信息的时候使用。
             * 使用方法：Yii::info()
             */
            [
                'class' => 'yiier\helpers\FileTarget',
                'enabled' => false, // 表示关闭
                // 日志等级
                'levels' => ['info'],
                // 被收集记录的额外数据
                'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION', '_SERVER'],
                // 指定日志保存的文件名
                'logFile' => '@app/runtime/logs/info/app.log',
                // 是否开启日志 (@app/runtime/logs/info/20151223_app.log)
                'enableDatePrefix' => true,
            ],
            /**
             * trace 级别日志：记录关于某段代码运行的相关消息。主要是用于开发环境。
             * 使用方法：Yii::trace()
             */
            [
                'class' => 'yiier\helpers\FileTarget',
                'enabled' => false, // 表示关闭
                // 日志等级
                'levels' => ['trace'],
                // 被收集记录的额外数据
                'logVars' => ['_GET', '_POST', '_FILES', '_COOKIE', '_SESSION', '_SERVER'],
                // 指定日志保存的文件名
                'logFile' => '@app/runtime/logs/trace/app.log',
                // 是否开启日志 (@app/runtime/logs/trace/20151223_app.log)
                'enableDatePrefix' => true,
            ],
            [
                'class' => 'yiier\helpers\FileTarget',
                'enabled' => false, // 表示关闭
                'levels' => ['profile'],
                'logVars' => [],
                'maxFileSize' => 1024,
                'logFile' => '@app/runtime/logs/app/app.log',
                'enableDatePrefix' => true,
            ],
        ],
    ],
],
```


### ResponseHandler

RESTful Response Handler, change config file `main.php`:

```php
'components' => [
    'response' => [
        'class' => 'yii\web\Response',
        'on beforeSend' => function ($event) {
            yii::createObject([
                'class' => 'yiier\helpers\ResponseHandler',
                'event' => $event,
            ])->formatResponse();
        },
    ],
]
```

### Migration

```php
<?php

use yiier\helpers\Migration;

class m170810_084615_create_post extends Migration
{
    /**
     * @var string
     */
    public $tableName = '{{%post}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
    
}
```

### String Helper

```php
yiier\helpers\String::after('@', 'biohazard@online.ge'); // 'online.ge'

yiier\helpers\String::afterLast('[', 'sin[90]*cos[180]');// '180]'

yiier\helpers\String::before('@', 'biohazard@online.ge'); // 'biohazard'

yiier\helpers\String::beforeLast('[', 'sin[90]*cos[180]'); // 'sin[90]*cos'

yiier\helpers\String::between('@', '.', 'biohazard@online.ge'); // 'online'

yiier\helpers\String::betweenLast('[', ']', 'sin[90]*cos[180]'); // '180'
```

### Setup Helper

```php
yiier\helpers\Setup::toFen(100); // 10000
yiier\helpers\Setup::toYuan(100); // 1

\yiier\helpers\Setup::errorMessage($model->firstErrors);
```

### Date Helper

```php
\yiier\helpers\DateHelper::convert('1454214981');
\yiier\helpers\DateHelper::convert('1454214981','date');
\yiier\helpers\DateHelper::convert('1454214981','time');

//……
```

### Security

```php
<?php
yiier\helpers\Security::random();
yiier\helpers\Security::generateSalt();
yiier\helpers\Security::generateRealUniqId();
```


……