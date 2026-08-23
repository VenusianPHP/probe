<?php

use Venusian\Probe\ProbeCaster;
use Voyager\NutsAndBolts\Collection;

it('can cast a collection', function () {
    $result = ProbeCaster::castCollection(new Collection(['foo', 'bar']));

    expect(array_values($result))->toBe([['foo', 'bar']]);
});
