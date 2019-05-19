<h1 align="center">Laravel Html Detector</h1>
<p>The package is to help to check html tag closure. If there are any tags unclosed, it will throw a alert.</p>

![截图](https://github.com/zhouzishu/laravel-html-detector/blob/master/show.png)

## Installing

```shell
$ composer require zhouzishu/laravel-html-detector
```

## Usage

Add the package's service provider to your app in your project's AppServiceProvider:

```php
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (config('app.debug')) {
            $this->app->register('Zhouzishu\LaravelHtmlDetector\ServiceProvider');
        }
    }
}
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/zhouzishu/laravel-html-detector/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/zhouzishu/laravel-html-detector/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT