<?php

namespace Venusian\Probe;

use Voyager\Contracts\Vessel\DataBindingException;
use Voyager\Contracts\NutsAndBolts\DeferrableProvider;
use Voyager\NutsAndBolts\ServiceProvider;
use Venusian\Probe\Console\ProbeCommand;

class ProbeServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        // Probe is a computer command. Rocket runs sketches, and its loop holds mail for one.
        if ($this->app->isRocketRunning()) {
            return;
        }

        $this->app->registerSingleton('command.probe', function () {
            return new ProbeCommand;
        });

        $this->commands(['command.probe']);
    }

    /**
     * Boot the service provider.
     *
     * @return void
     *
     * @throws DataBindingException
     */
    public function boot(): void
    {
        $source = realpath($raw = __DIR__.'/../config/probe.php') ?: $raw;

        $this->publishes([$source => $this->app->configPath('probe.php')]);

        $this->mergeConfigFrom($source, 'probe');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return ['command.probe'];
    }
}
