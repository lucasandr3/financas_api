<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/lumen';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'brick/math' => '0.9.3@ca57d18f028f84f777b2168cd1911b0dee2343ae',
  'doctrine/inflector' => '2.0.4@8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dragonmantank/cron-expression' => 'v3.2.3@47c53bbb260d3c398fba9bfa9683dcf67add2579',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'graham-campbell/result-type' => 'v1.0.4@0690bde05318336c7221785f2a932467f98b64ca',
  'guzzlehttp/guzzle' => '7.4.1@ee0a041b1760e6a53d2a39c8c34115adc2af2c79',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '2.1.0@089edd38f5b8abba6cb01567c2a8aaa47cec4c72',
  'illuminate/auth' => 'v8.78.1@02b166738b6e7449e18fe595822abeac59b7e317',
  'illuminate/broadcasting' => 'v8.78.1@b6907c0e93b290e949987162e48394cbcec1cc2f',
  'illuminate/bus' => 'v8.78.1@82ed7d9d6edc625ffe5d01fe17af3e223aed1cb0',
  'illuminate/cache' => 'v8.78.1@0f307e63c11ba99122a3d864647125788aac6db8',
  'illuminate/collections' => 'v8.78.1@e8c1cbd7a4cc8fb0e6a8978a55ef6d49c90bea59',
  'illuminate/config' => 'v8.78.1@70973cbbe0cb524658b6eeaa2386dd5b71de4b02',
  'illuminate/console' => 'v8.78.1@64d131e6c7b0901a2016c78b7319df472da8aa9a',
  'illuminate/container' => 'v8.78.1@6ac391bb27391706c5f921b85060aa2c4ca03fae',
  'illuminate/contracts' => 'v8.78.1@9baa9f781071e67d7b171775bd3be7ead13ddd29',
  'illuminate/database' => 'v8.78.1@6b41b297a22af2bdb12d33342bb1ec0866afd10b',
  'illuminate/encryption' => 'v8.78.1@3ff5c78f402c81da4b2ad4bef8f747a13e6fb0ff',
  'illuminate/events' => 'v8.78.1@b7f06cafb6c09581617f2ca05d69e9b159e5a35d',
  'illuminate/filesystem' => 'v8.78.1@def8901b69cd04902de0c2752683bab5e4d121b5',
  'illuminate/hashing' => 'v8.78.1@2617f4de8d0150a3f8641b086fafac8c1e0cdbf2',
  'illuminate/http' => 'v8.78.1@893bd4a1c2d29e063974fe97c6cd7ac65f683266',
  'illuminate/log' => 'v8.78.1@ac693c06fbc60ac344c55925d34aa811b85f1455',
  'illuminate/macroable' => 'v8.78.1@aed81891a6e046fdee72edd497f822190f61c162',
  'illuminate/pagination' => 'v8.78.1@d631f65e67f1b575642f9faaff54ac6d42791e80',
  'illuminate/pipeline' => 'v8.78.1@23aeff5b26ae4aee3f370835c76bd0f4e93f71d2',
  'illuminate/queue' => 'v8.78.1@7111e907b4febe419c512a27ca4ce0510638308d',
  'illuminate/session' => 'v8.78.1@c5964a2348354f266fb18aac60eed0b81355c258',
  'illuminate/support' => 'v8.78.1@0c2a4db0c60b33d30af0ae6bc2b31159d6c49361',
  'illuminate/testing' => 'v8.78.1@feca7bc8f4de97434e3923ae7b09c5c047d46038',
  'illuminate/translation' => 'v8.78.1@c10a68f37f590dc8c1c1fe5b6ad3f09381282137',
  'illuminate/validation' => 'v8.78.1@4712f28f5f57fdb2d03e0e4f58b3e236ad704381',
  'illuminate/view' => 'v8.78.1@ec853721a70c11d51c6162a58410abb319a073b1',
  'laravel/lumen-framework' => 'v8.3.4@733d1199d3344be337743f11df31b4048ec7fd1c',
  'laravel/serializable-closure' => 'v1.0.5@25de3be1bca1b17d52ff0dc02b646c667ac7266c',
  'lcobucci/jwt' => '3.3.3@c1123697f6a2ec29162b82f170dd4a491f524773',
  'league/flysystem' => '1.1.9@094defdb4a7001845300334e7c1ee2335925ef99',
  'league/mime-type-detection' => '1.9.0@aa70e813a6ad3d1558fc927863d47309b4c23e69',
  'monolog/monolog' => '2.3.5@fd4380d6fc37626e2f799f29d91195040137eba9',
  'namshi/jose' => '7.2.3@89a24d7eb3040e285dd5925fcad992378b82bcff',
  'nesbot/carbon' => '2.55.2@8c2a18ce3e67c34efc1b29f64fe61304368259a2',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'orangehill/iseed' => 'v3.0.1@874f77a20d49aa4c6c5fec2daf0daa070514e013',
  'phpmailer/phpmailer' => 'v6.5.3@baeb7cde6b60b1286912690ab0693c7789a31e71',
  'phpoption/phpoption' => '1.8.1@eab7a0df01fe2344d172bff4cd6dbd3f8b84ad15',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.2.2@cccc74ee5e328031b15640b51056ee8d3bb66c0a',
  'ramsey/uuid' => '4.2.3@fc9bb7fb5388691fd7373cd44dcb4d63bbcf24df',
  'symfony/console' => 'v5.4.2@a2c6b7ced2eb7799a35375fb9022519282b5405e',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/error-handler' => 'v5.4.2@e0c0dd0f9d4120a20158fc9aec2367d07d38bc56',
  'symfony/event-dispatcher' => 'v5.4.0@27d39ae126352b9fa3be5e196ccf4617897be3eb',
  'symfony/event-dispatcher-contracts' => 'v2.5.0@66bea3b09be61613cd3b4043a65a8ec48cfa6d2a',
  'symfony/finder' => 'v5.4.2@e77046c252be48c48a40816187ed527703c8f76c',
  'symfony/http-foundation' => 'v5.4.2@ce952af52877eaf3eab5d0c08cc0ea865ed37313',
  'symfony/http-kernel' => 'v5.4.2@35b7e9868953e0d1df84320bb063543369e43ef5',
  'symfony/mime' => 'v5.4.2@1bfd938cf9562822c05c4d00e8f92134d3c8e42d',
  'symfony/polyfill-ctype' => 'v1.24.0@30885182c981ab175d4d034db0f6f469898070ab',
  'symfony/polyfill-intl-grapheme' => 'v1.24.0@81b86b50cf841a64252b439e738e97f4a34e2783',
  'symfony/polyfill-intl-idn' => 'v1.24.0@749045c69efb97c70d25d7463abba812e91f3a44',
  'symfony/polyfill-intl-normalizer' => 'v1.24.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.24.0@0abb51d2f102e00a4eefcf46ba7fec406d245825',
  'symfony/polyfill-php56' => 'v1.20.0@54b8cd7e6c1643d78d011f3be89f3ef1f9f4c675',
  'symfony/polyfill-php72' => 'v1.24.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.24.0@cc5db0e22b3cb4111010e48785a97f670b350ca5',
  'symfony/polyfill-php80' => 'v1.24.0@57b712b08eddb97c762a8caa32c84e037892d2e9',
  'symfony/polyfill-php81' => 'v1.24.0@5de4ba2d41b15f9bd0e19b2ab9674135813ec98f',
  'symfony/process' => 'v5.4.2@2b3ba8722c4aaf3e88011be5e7f48710088fb5e4',
  'symfony/service-contracts' => 'v2.5.0@1ab11b933cd6bc5464b08e81e2c5b07dec58b0fc',
  'symfony/string' => 'v5.4.2@e6a5d5ecf6589c5247d18e0e74e30b11dfd51a3d',
  'symfony/translation' => 'v5.4.2@ff8bb2107b6a549dc3c5dd9c498dcc82c9c098ca',
  'symfony/translation-contracts' => 'v2.5.0@d28150f0f44ce854e942b671fc2620a98aae1b1e',
  'symfony/var-dumper' => 'v5.4.2@1b56c32c3679002b3a42384a580e16e2600f41c1',
  'tymon/jwt-auth' => 'dev-develop@ab00f2d7cce5f043067aef7849cdc792de2df635',
  'vlucas/phpdotenv' => 'v5.4.1@264dce589e7ce37a7ba99cb901eed8249fbec92f',
  'voku/portable-ascii' => '1.5.6@80953678b19901e5165c56752d087fc11526017c',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'composer/package-versions-deprecated' => '1.11.99.4@b174585d1fe49ceed21928a945138948cb394600',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '3.2.1@4caf37acf14b513a91dd4f087f7eda424fa25542',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'fakerphp/faker' => 'v1.17.0@b85e9d44eae8c52cca7aa0939483611f7232b669',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'kitloong/laravel-migrations-generator' => 'v5.1.2@b53917809a3165005a4d5b558c6c880d53668182',
  'mockery/mockery' => '1.4.4@e01123a0e847d52d186c5eb4b9bf58b0c6d00346',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.1.0@bae7c545bef187884426f042434e561ab1ddb182',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.6.0@93ebd0014cab80c4ea9f5e297ea48672f1b87706',
  'phpspec/prophecy' => 'v1.15.0@bbcd7380b0ebf3961ee21409db7b38bc31d69a13',
  'phpunit/php-code-coverage' => '9.2.10@d5850aaf931743067f4bfc1ae4cbd06468400687',
  'phpunit/php-file-iterator' => '3.0.6@cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf',
  'phpunit/php-invoker' => '3.1.1@5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
  'phpunit/php-text-template' => '2.0.4@5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
  'phpunit/php-timer' => '5.0.3@5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
  'phpunit/phpunit' => '9.5.11@2406855036db1102126125537adb1406f7242fdd',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'sebastian/cli-parser' => '1.0.1@442e7c7e687e42adc03470c7b668bc4b2402c0b2',
  'sebastian/code-unit' => '1.0.8@1fc9f64c0927627ef78ba436c9b17d967e68e120',
  'sebastian/code-unit-reverse-lookup' => '2.0.3@ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
  'sebastian/comparator' => '4.0.6@55f4261989e546dc112258c7a75935a81a7ce382',
  'sebastian/complexity' => '2.0.2@739b35e53379900cc9ac327b2147867b8b6efd88',
  'sebastian/diff' => '4.0.4@3461e3fccc7cfdfc2720be910d3bd73c69be590d',
  'sebastian/environment' => '5.1.3@388b6ced16caa751030f6a69e588299fa09200ac',
  'sebastian/exporter' => '4.0.4@65e8b7db476c5dd267e65eea9cab77584d3cfff9',
  'sebastian/global-state' => '5.0.3@23bd5951f7ff26f12d4e3242864df3e08dec4e49',
  'sebastian/lines-of-code' => '1.0.3@c1c2e997aa3146983ed888ad08b15470a2e22ecc',
  'sebastian/object-enumerator' => '4.0.4@5c9eeac41b290a3712d88851518825ad78f45c71',
  'sebastian/object-reflector' => '2.0.4@b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
  'sebastian/recursion-context' => '4.0.4@cd9d8cf3c5804de4341c283ed787f099f5506172',
  'sebastian/resource-operations' => '3.0.3@0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
  'sebastian/type' => '2.3.4@b8cd8a1c753c90bc1a0f5372170e3e489136f914',
  'sebastian/version' => '3.0.2@c6c1022351a901512170118436c764e473f6de8c',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'laravel/lumen' => 'dev-main@6d3cfc48a962a5610305c5f6d6b8d3fece20cb1a',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
