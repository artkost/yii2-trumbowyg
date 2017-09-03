The Trumbowyg WYSIWYG Editor widget for Yii 2
==================================

Wrapper for [Trumbowyg WYSIWYG](http://alex-d.github.io/Trumbowyg/).


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist artkost/yii2-trumbowyg "@stable"
```

or add

```
"artkost/yii2-trumbowyg": "@stable"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, simply use it in your code:

### Use as widget ###

```php
echo \artkost\yii2\trumbowyg\Trumbowyg::widget([
    'name' => 'myname',
    'settings' => [
        'lang' => 'ru'
    ]
]);
```

### Use as ActiveForm widget ###

```php
use artkost\yii2\trumbowyg\Trumbowyg;

echo $form->field($model, 'content')->widget(Trumbowyg::className(), [
    'settings' => [
        'lang' => 'ru'
    ]
]);
```
