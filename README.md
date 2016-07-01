# tg-pass

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require michaljurkowski/tg-pass
```

Add ServiceProvider to `config/app`.

```
MichalJurkowski\TgPass\TgPassServiceProvider::class,
```
## Usage

Use `php artisan vendor:publish`

in `config/tg_pass` uncomment or add your own roles and permissions

in database/seeds/DatabaseSeeder.php add:

```     $this->call(PassUsersTableSeeder::class);
        $this->call(PassRolesTableSeeder::class);
        $this->call(PassResourcesTableSeeder::class);
        $this->call(PassUserRolesTableSeeder::class);
        $this->call(PassPermissionsTableSeeder::class);
```


in user model use trait
```
    use MichalJurkowski\TgPass\Engine\Models\Traits\PassUserTrait;

    class User
        {
        use PassUserTrait;
```

`composer dump-autoload`

then `php artisan migrate` and `php artisan db:seed`

## Security

If you discover any security related issues, please email jurkowskimichal86@gmail.com instead of using the issue tracker.

## Credits

- [Michał Jurkowski][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/michaljurkowski/tg-pass.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/michaljurkowski/tg-pass/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/michaljurkowski/tg-pass.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/michaljurkowski/tg-pass.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/michaljurkowski/tg-pass.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/michaljurkowski/tg-pass
[link-travis]: https://travis-ci.org/michaljurkowski/tg-pass
[link-scrutinizer]: https://scrutinizer-ci.com/g/michaljurkowski/tg-pass/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/michaljurkowski/tg-pass
[link-downloads]: https://packagist.org/packages/michaljurkowski/tg-pass
[link-author]: https://github.com/michaljurkowski
[link-contributors]: ../../contributors
