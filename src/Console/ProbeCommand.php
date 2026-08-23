<?php

namespace Venusian\Probe\Console;

use Psy\Shell;
use Throwable;
use Psy\Configuration;
use Voyager\Console\Command;
use Voyager\NutsAndBolts\DataObjects\Env;
use Psy\VersionUpdater\Checker;
use Venusian\Probe\ClassAliasAutoloader;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Voyager\Contracts\Vessel\BindingResolutionException;

class ProbeCommand extends Command
{
    /**
     * Computer commands to include in the probe shell.
     *
     * @var array
     */
    protected array $commandWhitelist = [
        'clear-compiled', 'down', 'env', 'inspire', 'migrate', 'migrate:install', 'optimize', 'up',
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected ?string $name = 'probe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Interact with your application';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws BindingResolutionException
     */
    public function handle(): int
    {
        $this->getApplication()->setCatchExceptions(false);

        $config = Configuration::fromInput($this->input);
        $config->setUpdateCheck(Checker::NEVER);

        $appConfig = $this->getVenusian()->make('config');
        $config->setTrustProject($appConfig->get('probe.trust_project'));

        // Hardware IO (MPSSE/FTDI/libusb) is unsafe after pcntl_fork on macOS.
        // Default off; opt in via probe.use_pcntl / PROBE_USE_PCNTL.
        $config->setUsePcntl((bool) $appConfig->get('probe.use_pcntl', false));

        $config->getPresenter()->addCasters(
            $this->getCasters()
        );

        if ($this->option('execute')) {
            $config->setRawOutput(true);
        }

        $shell = new Shell($config);
        $shell->addCommands($this->getCommands());
        $shell->setIncludes($this->argument('include'));

        $path = Env::get('COMPOSER_VENDOR_DIR', $this->getVenusian()->basePath().DIRECTORY_SEPARATOR.'vendor');

        $path .= '/composer/autoload_classmap.php';

        $loader = ClassAliasAutoloader::register(
            $shell, $path, $appConfig->get('probe.alias', []), $appConfig->get('probe.dont_alias', [])
        );

        if ($code = $this->option('execute')) {
            try {
                $shell->setOutput($this->output);
                $shell->execute($code, true);
            } catch (Throwable $e) {
                $shell->writeException($e);

                return 1;
            } finally {
                $loader->unregister();
            }

            return 0;
        }

        try {
            return $shell->run();
        } finally {
            $loader->unregister();
        }
    }

    /**
     * Get Computer commands to pass through to PsySH.
     *
     * @return array
     * @throws BindingResolutionException
     */
    protected function getCommands(): array
    {
        $commands = [];

        foreach ($this->getApplication()->all() as $name => $command) {
            if (in_array($name, $this->commandWhitelist)) {
                $commands[] = $command;
            }
        }

        $config = $this->getVenusian()->make('config');

        foreach ($config->get('probe.commands', []) as $command) {
            $commands[] = $this->getApplication()->add(
                $this->getVenusian()->make($command)
            );
        }

        return $commands;
    }

    /**
     * Get an array of Venusian tailored casters.
     *
     * @return array
     * @throws BindingResolutionException
     */
    protected function getCasters(): array
    {
        $casters = [
            'Voyager\NutsAndBolts\Collection' => 'Venusian\Probe\ProbeCaster::castCollection',
            'Voyager\NutsAndBolts\DataObjects\Stringable' => 'Venusian\Probe\ProbeCaster::castStringable',
            'Voyager\NutsAndBolts\HtmlString' => 'Venusian\Probe\ProbeCaster::castHtmlString',
        ];

        if (class_exists('Voyager\Process\ProcessResult')) {
            $casters['Voyager\Process\ProcessResult'] = 'Venusian\Probe\ProbeCaster::castProcessResult';
        }

        if (class_exists('Voyager\System\Application')) {
            $casters['Voyager\System\Application'] = 'Venusian\Probe\ProbeCaster::castApplication';
        }

        $config = $this->getVenusian()->make('config');

        return array_merge($casters, (array) $config->get('probe.casters', []));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['include', InputArgument::IS_ARRAY, 'Include file(s) before starting probe'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['execute', null, InputOption::VALUE_OPTIONAL, 'Execute the given code using Probe'],
        ];
    }
}
