Helpers for Yii2
================
Helpers for Yii2

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

**中国身份证号码验证**

```php
public function rules()
{
    return [
        // ... 
        ['id_card', '\yiier\helpers\validators\IdCardValidator'],
        // code
    ];
}
```

**Array Validator**

```php
public function rules()
{
    return [
        // ... 
        ['product_ids', '\yiier\helpers\validators\ArrayValidator'],
        // code
    ];
}
```

……