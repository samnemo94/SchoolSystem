<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0d1d3c13f80202964b8b82ff7f2fb863
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'y' => 
        array (
            'yii\\swiftmailer\\' => 16,
            'yii\\materialicons\\' => 18,
            'yii\\gii\\' => 8,
            'yii\\faker\\' => 10,
            'yii\\debug\\' => 10,
            'yii\\composer\\' => 13,
            'yii\\codeception\\' => 16,
            'yii\\bootstrap\\' => 14,
            'yii\\' => 4,
        ),
        'w' => 
        array (
            'wbraganca\\dynamicform\\' => 22,
        ),
        'r' => 
        array (
            'rmrevin\\yii\\fontawesome\\' => 24,
        ),
        'l' => 
        array (
            'lajax\\languagepicker\\' => 21,
        ),
        'k' => 
        array (
            'kartik\\select2\\' => 15,
            'kartik\\plugins\\fileinput\\' => 25,
            'kartik\\growl\\' => 13,
            'kartik\\file\\' => 12,
            'kartik\\base\\' => 12,
        ),
        'd' => 
        array (
            'dosamigos\\ckeditor\\' => 19,
        ),
        'c' => 
        array (
            'cebe\\markdown\\' => 14,
        ),
        'a' => 
        array (
            'airani\\bootstrap\\' => 17,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\DomCrawler\\' => 29,
            'Symfony\\Component\\CssSelector\\' => 30,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'yii\\swiftmailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-swiftmailer',
        ),
        'yii\\materialicons\\' => 
        array (
            0 => __DIR__ . '/..' . '/mervick/yii2-material-design-icons',
        ),
        'yii\\gii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-gii',
        ),
        'yii\\faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-faker',
        ),
        'yii\\debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-debug',
        ),
        'yii\\composer\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-composer',
        ),
        'yii\\codeception\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-codeception',
        ),
        'yii\\bootstrap\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2-bootstrap',
        ),
        'yii\\' => 
        array (
            0 => __DIR__ . '/..' . '/yiisoft/yii2',
        ),
        'wbraganca\\dynamicform\\' => 
        array (
            0 => __DIR__ . '/..' . '/wbraganca/yii2-dynamicform',
        ),
        'rmrevin\\yii\\fontawesome\\' => 
        array (
            0 => __DIR__ . '/..' . '/rmrevin/yii2-fontawesome',
        ),
        'lajax\\languagepicker\\' => 
        array (
            0 => __DIR__ . '/..' . '/lajax/yii2-language-picker',
        ),
        'kartik\\select2\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-select2',
        ),
        'kartik\\plugins\\fileinput\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/bootstrap-fileinput',
        ),
        'kartik\\growl\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-growl',
        ),
        'kartik\\file\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-widget-fileinput',
        ),
        'kartik\\base\\' => 
        array (
            0 => __DIR__ . '/..' . '/kartik-v/yii2-krajee-base',
        ),
        'dosamigos\\ckeditor\\' => 
        array (
            0 => __DIR__ . '/..' . '/2amigos/yii2-ckeditor-widget/src',
        ),
        'cebe\\markdown\\' => 
        array (
            0 => __DIR__ . '/..' . '/cebe/markdown',
        ),
        'airani\\bootstrap\\' => 
        array (
            0 => __DIR__ . '/..' . '/airani/yii2-bootstrap-rtl',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\DomCrawler\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/dom-crawler',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'D' => 
        array (
            'Diff' => 
            array (
                0 => __DIR__ . '/..' . '/phpspec/php-diff/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0d1d3c13f80202964b8b82ff7f2fb863::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0d1d3c13f80202964b8b82ff7f2fb863::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0d1d3c13f80202964b8b82ff7f2fb863::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
