<?php

namespace Venusian\Probe;

use Voyager\NutsAndBolts\Collection;
use Voyager\NutsAndBolts\HtmlString;
use Voyager\NutsAndBolts\DataObjects\Stringable;
use Voyager\System\Application;
use Symfony\Component\VarDumper\Caster\Caster;

class ProbeCaster
{
    /**
     * Application methods to include in the presenter.
     *
     * @var list<string>
     */
    private static array $appProperties = [
        'configurationIsCached',
        'environment',
        'environmentFile',
        'eventsAreCached',
        'runningUnitTests',
        'version',
        'path',
        'basePath',
        'configPath',
        'databasePath',
        'storagePath',
        'bootstrapPath',
    ];

    /**
     * Get an array representing the properties of an application.
     *
     * @param  Application  $app
     * @return array<string, mixed>
     */
    public static function castApplication(Application $app): array
    {
        $results = [];

        foreach (self::$appProperties as $property) {
            try {
                $val = $app->$property();

                if (! is_null($val)) {
                    $results[Caster::PREFIX_VIRTUAL.$property] = $val;
                }
            } catch (\Throwable) {
                //
            }
        }

        return $results;
    }

    /**
     * Get an array representing the properties of a collection.
     *
     * @param  Collection  $collection
     * @return array<string, mixed>
     */
    public static function castCollection(Collection $collection): array
    {
        return [
            Caster::PREFIX_VIRTUAL.'all' => $collection->all(),
        ];
    }

    /**
     * Get an array representing the properties of a fluent string.
     *
     * @param  Stringable  $stringable
     * @return array<string, mixed>
     */
    public static function castStringable(Stringable $stringable): array
    {
        return [
            Caster::PREFIX_VIRTUAL.'value' => (string) $stringable,
        ];
    }

    /**
     * Get an array representing the properties of an HTML string.
     *
     * @param  HtmlString  $htmlString
     * @return array<string, mixed>
     */
    public static function castHtmlString(HtmlString $htmlString): array
    {
        return [
            Caster::PREFIX_VIRTUAL.'html' => $htmlString->toHtml(),
        ];
    }

    /**
     * Get an array representing the properties of a process result.
     *
     * Registered only when Voyager\Process\ProcessResult exists.
     *
     * @param  object  $result
     * @return array<string, mixed>
     */
    public static function castProcessResult(object $result): array
    {
        return [
            Caster::PREFIX_VIRTUAL.'output' => $result->output(),
            Caster::PREFIX_VIRTUAL.'errorOutput' => $result->errorOutput(),
            Caster::PREFIX_VIRTUAL.'exitCode' => $result->exitCode(),
            Caster::PREFIX_VIRTUAL.'successful' => $result->successful(),
        ];
    }
}
