Laravel 5 Mail CSS Inliner
========================

## Why?
Most email clients won't render CSS (on a `<link>` or a `<style>`). The solution is to inline your CSS directly into the HTML. Doing this by hand is tedious and difficult to maintain.
The goal of this package is to automate the process of inlining that CSS before sending the emails.



## How?
Using a wonderful [CSS inliner package](https://github.com/jjriv/emogrifier) wraped in a SwiftMailer plugin and served as a Service Provider. It works without configuration

Transforming:
```html
<html>
    <head>
        <style>
            h1 {
                font-size: 24px;
                color: #000;
            }
        </style>
    </head>
    <body>
        <h1>Your content</h1>
    </body>
</html>
```

Into this:
```html
<html>
    <head>
    </head>
    <body>
        <h1 style="font-size: 24px; color: #000;">Your content</h1>
    </body>
</html>
```

## Installation
Begin by installing this package through Composer. Edit your project's `composer.json` file to require `igonics/laravel-mail-css-inliner`.

This package requires Laravel 5.x
```json
{
  "require": {
        "igonics/laravel-mail-css-inliner": "~0.*"
    }
}
```

Next, update Composer from the Terminal:
```bash
$ composer update
```

Once this operation completes, you must add the service provider. Open `app/config/app.php`, and add a new item to the providers array.
```php
'IGonics\LaravelMailCssInliner\LaravelMailCssInlinerServiceProvider',
```

## Found a bug?
Please, let me know! Send a pull request or a patch. Questions? Ask! I will respond to all filed issues.

## Inspiration
This package was greatly inspired by [Emogrifier CSS Inliner](https://github.com/jjriv/emogrifier) and [Fede Isas's](https://github.com/fedeisas/laravel-mail-css-inliner) implementation of a similar service provider. The implementation became less configurable however with its main dependency [CssToInlineStyles](https://github.com/tijsverkoyen/CssToInlineStyles) becoming less configurable with it's latest update which presented breaking changes to the existing API. This package was created as a more configurable solution with the ability to also handle poorly formatted HTML, which the previous implementations had issues with.

## License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)