<?php

namespace Venusian\Probe;

use Voyager\Contracts\Vessel\BindingResolutionException;
use Voyager\Contracts\NutsAndBolts\DeferrableProvider;
use Voyager\NutsAndBolts\ServiceProvider;
use Voyager\System\Console\AboutCommand;
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
        $this->app->singleton('command.probe', function () {
            return new ProbeCommand;
        });

        $this->commands(['command.probe']);
    }

    /**
     * Boot the service provider.
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $source = realpath($raw = __DIR__.'/../config/probe.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => $this->app->configPath('probe.php')]);
        }

        $this->mergeConfigFrom($source, 'probe');

        AboutCommand::add('Environment', [
            'Probe Installed' => AboutCommand::format(
                true,
                console: fn ($value) => $value
                    ? '<fg=green;options=bold>YES</>'
                    : '<fg=yellow;options=bold>NO</>',
            ),
        ]);
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
