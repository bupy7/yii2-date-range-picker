yii2-date-range-picker
=====================

Wrapper of bootstrap date range picker for Yii2.

More information about plugin: https://github.com/dangrossman/bootstrap-daterangepicker

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bupy7/yii2-date-range "*"
```

or add

```
"bupy7/yii2-date-range": "*"
```

to the require section of your `composer.json` file.


Usage
-----

As field of form:

```php
echo $form->field($model, 'date_range')->widget(DateRangePicker::className(), [
    'pluginOptions' => [
        // see http://www.daterangepicker.com/#options
    ],

    'pluginEvents' => [
        // see http://www.daterangepicker.com/#events
    ],

    // Language of plugin. If `null` then `\yii\base\Application::language` will be used.
    'language' => 'en',

    // Converting date format from PHP DateTime to Moment.js DateTime.
    'convertDateFormat' => true,

    // Options of field input.
    'options' => [

    ],
]);
```

As an independent widget:

```php
DateRangePicker::widget([
    'name' => 'date_time',

    'pluginOptions' => [
        // see http://www.daterangepicker.com/#options
    ],

    'pluginEvents' => [
        // see http://www.daterangepicker.com/#events
    ],

    // Language of plugin. If `null` then `\yii\base\Application::language` will be used.
    'language' => 'en',

    // Converting date format from PHP DateTime to Moment.js DateTime.
    'convertDateFormat' => true,

    // Options of field input.
    'options' => [

    ],
]);
```

##License

yii2-date-range-picker is released under the BSD 3-Clause License.