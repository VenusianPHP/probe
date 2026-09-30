<?php

use Venusian\Probe\ProbeCaster;
use Symfony\Component\VarDumper\Caster\Caster;
use Voyager\Core\RenderedInstance;
use Voyager\Database\Instrument\Model;
use Voyager\NutsAndBolts\Collection;

it('can cast a collection', function () {
    $result = ProbeCaster::castCollection(new Collection(['foo', 'bar']));

    expect(array_values($result))->toBe([['foo', 'bar']]);
});

it('casts a framework core to its version, environment and paths', function () {
    $base = sys_get_temp_dir();

    $result = ProbeCaster::castApplication(new RenderedInstance($base));

    expect($result)
        ->toHaveKey(Caster::PREFIX_VIRTUAL.'version', RenderedInstance::VERSION)
        ->toHaveKey(Caster::PREFIX_VIRTUAL.'basePath', $base)
        ->toHaveKey(Caster::PREFIX_VIRTUAL.'signalsAreCached', false)
        ->not->toHaveKey(Caster::PREFIX_VIRTUAL.'eventsAreCached');
});

it('casts an instrument model with hidden attributes protected and appends evaluated', function () {
    $model = new class extends Model
    {
        protected $hidden = ['password'];

        protected $appends = ['shout'];

        public function getShoutAttribute(): string
        {
            return strtoupper($this->name);
        }
    };

    $model->setRawAttributes(['name' => 'ada', 'password' => 'secret']);

    expect(ProbeCaster::castModel($model))->toBe([
        Caster::PREFIX_VIRTUAL.'name' => 'ada',
        Caster::PREFIX_PROTECTED.'password' => 'secret',
        Caster::PREFIX_VIRTUAL.'shout' => 'ADA',
    ]);
});
