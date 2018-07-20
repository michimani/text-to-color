# text-to-color
Generate color code from a string.

# How to use

1. install using composer

```console
composer require michimani/text-to-color
```

and require the main file.

```php
require_once('./txt2color.php');
```

2. create the object.

```php
$t2c = new TextToColor();
```

3. call `generateColorHexFromString` function.

```php
$str = 'some string';
$color = $t2c->generateColorHexFromString($str);

echo $color;

// #10b51f
```

# Customize
If you want to change algorithm for generating color code, set some string to `$rand_str` in `TextToColor` class.

```diff
-  private $rand_str = 'some strings';
+  private $rand_str = 'other strings';
```

```php
$str = 'some string';
$color = $t2c->generateColorHexFromString($str);

echo $color;

// #0cf465
```

