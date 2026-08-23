# Agent guidelines — venusian/probe

## Knowledge Bundle (OKF)

This package ships an Open Knowledge Format bundle at [`.okf/`](.okf/) (excluded from Composer dist via `.gitattributes` `export-ignore`).

Before changing probe code or advising on this package:

1. Read [`.okf/index.md`](.okf/index.md) first (progressive disclosure).
2. Open only the linked concepts needed for the task.
3. Prefer `status: stable` concepts; treat `deprecated` as historical only. Concepts in this bundle are human-verified `stable` unless marked `deprecated`.
4. When you learn something durable about **this package**, update the affected `.okf` concept(s) and append `.okf/log.md`. New/changed concepts stay `status: draft` until a human verifies them.
5. Keep knowledge at the package-root `.okf/` only — do not nest `.okf` under `src/`.
6. Scope claims to **probe**. Voyager framework architecture belongs in `venusian/framework` OKF.

## Package rules (quick) — 0.8.0

- Composer: `venusian/probe` **0.8.0**. PHP target `^8.4|^8.5|^8.6`.
- Namespace: `Venusian\Probe\` → `src/`.
- Role: PsySH REPL as Computer command `probe` for Venusian applications.
- Companion to `venusian/framework` 0.8 — **not** a Voyager domain; owns `ProbeServiceProvider` and discovers via `extra.venusian.providers`.
- 0.8 provider: use `$this->app` (not `$this->container` / `$this->program`); `Voyager\Contracts\NutsAndBolts\DeferrableProvider`; `Voyager\Contracts\Vessel\BindingResolutionException`.
- Casters: `Voyager\NutsAndBolts\{Collection,HtmlString}` and `Voyager\NutsAndBolts\DataObjects\Stringable`; `class_exists` for `Voyager\Process\ProcessResult` and `Voyager\System\Application`.
- `probe.use_pcntl` defaults **false** (MPSSE/FTDI fork safety).
- Deferred provider needs console kernel bootstrap `loadDeferredProviders()`.
