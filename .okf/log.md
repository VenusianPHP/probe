# Directory Update Log

## 2026-08-23

* **Update**: Retargeted the bundle from `scrapyard-io/wrench` **0.7** to `venusian/probe` **0.8** — Wrench→Probe, ScrapyardIO→Venusian, Fabricate→Voyager, Workshop→computer, `$this->container`→`$this->app`. Concepts set `status: draft` pending human verification. Historical 0.7 import-path trap marked `deprecated`.

## 2026-08-07

* **Verification**: Angel marked all OKF concepts `status: stable` for 0.7.x publish prep (`verified` by `human:Angel Gonzalez (projectsaturnstudios)`). Index markers and AGENTS trust wording updated.
* **Update**: `WrenchServiceProvider::boot()` contributes to Workshop `about` — overrides Environment **Wrench Installed** from Core default `false`/`NO` to `true`/`YES` via `AboutCommand::add()`.
* **Update**: Applied 0.7 compatibility in source — `$this->container`, Nab `DeferrableProvider`, Chassis `BindingResolutionException`, HtmlString caster removed, Process caster untyped + `class_exists`, Machine caster drops `isLocal`, composer PHP/`branch-alias`/`suggest`, `WRENCH_TRUST_PROJECT`. App skeleton path-repo symlink for wrench.

* **Initialization**: Created OKF v0.2 bundle for `scrapyard-io/wrench` **0.7.0** — orientation, components (provider / command / caster / alias autoloader / config), companion-provider convention, pcntl + 0.7 import-path traps, require/use playbooks. All concepts `status: stable` pending human verification.
