# Changelog

All notable changes to `venusian/probe` (successor of `scrapyard-io/wrench`) are documented in this file.

## [0.8.0] — 2026-08-23

Companion release aligned with `venusian/framework` / Voyager **0.8**. Successor of `scrapyard-io/wrench` 0.7.

### Rename

- Package `scrapyard-io/wrench` → `venusian/probe`.
- Namespace `ScrapyardIO\Wrench\` → `Venusian\Probe\`.
- `WrenchServiceProvider` / `WrenchCommand` / `WrenchCaster` → `ProbeServiceProvider` / `ProbeCommand` / `ProbeCaster`.
- Computer command `wrench` → `probe`; binding `command.wrench` → `command.probe`.
- Config `config/wrench.php` / `wrench.*` → `config/probe.php` / `probe.*`.
- Env `WRENCH_USE_PCNTL` / `WRENCH_TRUST_PROJECT` → `PROBE_USE_PCNTL` / `PROBE_TRUST_PROJECT` (`TINKER_TRUST_PROJECT` remains a fallback).
- Discovery stays on `extra.venusian.providers` → `Venusian\Probe\ProbeServiceProvider`.

### Compatibility

- Target PHP `^8.4|^8.5|^8.6`.
- Require `voyager/console`, `voyager/contracts`, and `voyager/nuts-and-bolts` at `^0.8`.
- Fabricate is Voyager: `Voyager\Console\Command`, `Voyager\NutsAndBolts\ServiceProvider`, `Voyager\System\Application` (was Machine), `Voyager\System\Console\AboutCommand`.
- `ProbeServiceProvider` uses `$this->app` (Voyager `ServiceProvider` is Laravel-shaped; 0.7 `$this->container` is gone).
- Implement `Voyager\Contracts\NutsAndBolts\DeferrableProvider`.
- Import `Voyager\Contracts\Vessel\BindingResolutionException`.
- Command container accessor is `getVenusian()` (was `getScrapyardIO()`).
- Console binary is **computer** (was Workshop).
- Restore `HtmlString` caster (`Voyager\NutsAndBolts\HtmlString` is present in 0.8).
- Keep `ProcessResult` caster registration behind `class_exists` when Process is optional.
- Application caster registers `Voyager\System\Application` behind `class_exists`.
- Rely on console bootstrap `loadDeferredProviders()` so deferred `command.probe` is available to Computer.

### Safety / config

- `probe.use_pcntl` defaults to `false` (`PROBE_USE_PCNTL`) so PsySH forking does not break MPSSE/FTDI/libusb on macOS.

### Packaging

- Ship package-root OKF knowledge bundle (`.okf/`), `AGENTS.md`, and this changelog as `export-ignore` in Composer dist via `.gitattributes`.

### Notes

- Remains a Venusian companion package (`Venusian\Probe\`), not a Voyager domain component.

## [0.7.0] — 2026-08-07

Companion release of `scrapyard-io/wrench` aligned with `scrapyard-io/framework` / Fabricate **0.7**.

### Compatibility

- Target PHP `^8.4|^8.5|^8.6`.
- Require `fabricate/console`, `fabricate/contracts`, and `fabricate/nuts-and-bolts` at `^0.7`.
- `WrenchServiceProvider` uses `$this->container` (Fabricate `ServiceProvider` no longer exposes `$this->program`).
- Implement `Fabricate\NutsAndBolts\Contracts\DeferrableProvider` (moved out of `Fabricate\Contracts\NutsAndBolts\…`).
- Import `Fabricate\Chassis\Exceptions\BindingResolutionException` (concrete Chassis exception, not Contracts path).
- Remove or `class_exists`-guard `HtmlString` caster — `Fabricate\NutsAndBolts\HtmlString` is not present in 0.7.
- Keep `ProcessResult` caster registration behind `class_exists` when Process is optional.
- Rely on console bootstrap `loadDeferredProviders()` so deferred `command.wrench` is available to Workshop.

### Safety / config

- `wrench.use_pcntl` defaults to `false` (`WRENCH_USE_PCNTL`) so PsySH forking does not break MPSSE/FTDI/libusb on macOS.
- Prefer `WRENCH_TRUST_PROJECT` for PsySH trust mode (falls back to legacy `TINKER_TRUST_PROJECT`).
- Drop `isLocal` from Machine caster property list (not on 0.7 Machine).
- Document hardware fork hazard for operators enabling pcntl.

### Packaging

- Ship package-root OKF knowledge bundle (`.okf/`), `AGENTS.md`, and this changelog as `export-ignore` in Composer dist via `.gitattributes`.

### Notes

- Remained a ScrapyardIO companion package (`ScrapyardIO\Wrench\`), not a Fabricate domain component. Discovery stayed on `extra.scrapyard-io.providers` → `WrenchServiceProvider`.
