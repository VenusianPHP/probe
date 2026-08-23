---
type: Convention
title: Companion provider (not Voyager domain)
description: probe keeps Venusian\Probe\ProbeServiceProvider and discovers via composer extra.venusian.providers — not a Voyager domain owned by System.
tags: [convention, provider, discovery, companion]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: composer
    resource: composer.json
    title: extra.venusian.providers
  - id: provider
    resource: src/ProbeServiceProvider.php
    title: ProbeServiceProvider
  - id: framework-magic
    resource: venusian/framework .okf/packages/magic-aliases.md
    title: Framework magic-aliases convention (domains stay pure)
---

# Rule

`venusian/probe` is a **companion** to `venusian/framework` 0.8, not a Voyager domain package under `Voyager\*`.[^composer]

Therefore:

1. It **owns** `Venusian\Probe\ProbeServiceProvider` in this package.[^provider]
2. Discovery uses Composer `extra.venusian.providers` (not System-owned domain providers / MagicAliases).[^composer]
3. Do not relocate probe’s provider into framework System “for purity” — framework’s domain-purity rule applies to **Voyager domains**, not this companion.[^framework-magic]

# Related

- [Package (0.8)](../orientation/package.md)
- [ProbeServiceProvider](../components/service-provider.md)

[^composer]: extra.venusian.providers
[^provider]: ProbeServiceProvider
[^framework-magic]: Framework magic-aliases convention (domains stay pure)
