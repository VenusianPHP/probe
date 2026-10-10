<?php

use Venusian\Probe\Console\ProbeCommand;
use Venusian\Probe\ProbeServiceProvider;
use Voyager\Contracts\Core\FrameworkCore;
use Voyager\Console\ComputerConsoleInstance as Computer;

beforeEach(fn () => Computer::forgetBootstrappers());
afterEach(function () {
    Computer::forgetBootstrappers();
    Mockery::close();
});

$startingCallbacks = fn (): array => (new ReflectionProperty(Computer::class, 'bootstrappers'))->getValue();

it('registers the probe command on computer runs', function () use ($startingCallbacks) {
    $app = Mockery::mock(FrameworkCore::class);
    $app->shouldReceive('isRocketRunning')->once()->andReturnFalse();
    $app->shouldReceive('registerSingleton')->once()->with('command.probe', Mockery::on(fn (Closure $make) => $make() instanceof ProbeCommand));

    (new ProbeServiceProvider($app))->register();

    expect($startingCallbacks())->toHaveCount(1);
});

it('registers nothing while rocket is running', function () use ($startingCallbacks) {
    $app = Mockery::mock(FrameworkCore::class);
    $app->shouldReceive('isRocketRunning')->once()->andReturnTrue();
    $app->shouldNotReceive('registerSingleton');

    (new ProbeServiceProvider($app))->register();

    expect($startingCallbacks())->toBe([]);
});
