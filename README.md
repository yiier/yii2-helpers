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

**arrayShift**

```php
ArrayHelper::arrayShift([0 => 'a', 2 => 'c', 1 => 'b']);
// [2 => 'c', 1 => 'b']
```

**saveAll**

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

**Global Functions**

change `composer.json` file, add this:

```
"autoload": {
    "files": [
      "vendor/yiier/yii2-helpers/GlobalFunctions.php"
    ]
},
```

then run

```
$ composer dump
```

……
