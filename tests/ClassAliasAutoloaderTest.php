<?php

use Psy\Shell;
use Venusian\Probe\ClassAliasAutoloader;

beforeEach(function () {
    $this->classmapPath = __DIR__.'/fixtures/vendor/composer/autoload_classmap.php';
});

afterEach(function () {
    $this->loader?->unregister();

    Mockery::close();
});

it('can alias classes', function () {
    $this->loader = ClassAliasAutoloader::register(
        $shell = Mockery::mock(Shell::class),
        $this->classmapPath
    );

    $shell->shouldReceive('writeStdout')
        ->with("[!] Aliasing 'Bar' to 'App\\Foo\\Bar' for this Probe session.\n")
        ->once();

    expect(class_exists('Bar'))->toBeTrue()
        ->and(new Bar)->toBeInstanceOf(App\Foo\Bar::class);
});

it('can exclude namespaces from aliasing', function () {
    $this->loader = ClassAliasAutoloader::register(
        $shell = Mockery::mock(Shell::class),
        $this->classmapPath,
        [],
        ['App\\Baz']
    );

    $shell->shouldNotReceive('writeStdout');

    expect(class_exists('Qux'))->toBeFalse();
});

it('excludes vendor classes', function () {
    $this->loader = ClassAliasAutoloader::register(
        $shell = Mockery::mock(Shell::class),
        $this->classmapPath
    );

    $shell->shouldNotReceive('writeStdout');

    expect(class_exists('Three'))->toBeFalse();
});

it('can whitelist vendor classes', function () {
    $this->loader = ClassAliasAutoloader::register(
        $shell = Mockery::mock(Shell::class),
        $this->classmapPath,
        ['One\\Two']
    );

    $shell->shouldReceive('writeStdout')
        ->with("[!] Aliasing 'Three' to 'One\\Two\\Three' for this Probe session.\n")
        ->once();

    expect(class_exists('Three'))->toBeTrue()
        ->and(new Three)->toBeInstanceOf(One\Two\Three::class);
});
