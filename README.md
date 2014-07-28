yii2-blog
=========

A blog package for Yii2

This system is setup to use linchpinstudios\yii2-filemanager

Installation
===============

<h4>Composer:</h4>

<h5>1) Add to your composer.json</h5>
```
"require": {
  // ...
  "linchpinstudios/yii2-blog": "*",
  // ...
},
```

<h5>2) Update Composer</h5>
```
php composer.phar update
```

<h5>3) Run Migrations</h5>
<strong>For Blog</strong>
```
./yii migrate/up --migrationPath=@vendor/linchpinstudios/yii2-blog/migrations
```
<strong>For File Manager</strong>
```
./yii migrate/up --migrationPath=@vendor/linchpinstudios/yii2-filemanager/migrations
```

<h5>4) Configure Module</h5>
```php
'modules' => [
    // ...
    'filemanager' => [
        'class' => 'linchpinstudios\filemanager\Module',
        'aws' => [
            'enable' => true,
            'key' => 'YOUR_AWS_KEY',
            'secret' => 'YOUR_AWS_SECRET',
            'bucket' => 'YOUR_AWS_BUCKET',
            'url' => 'YOUR_AWS_URL',          //either s3 buket URL or CloudFront (can be changed)
        ],
    ],
    'blog' => [
        'class' => 'linchpinstudios\blog\Module',
    ]
    // ...
],
```


Usage
===============

Instructions to come
