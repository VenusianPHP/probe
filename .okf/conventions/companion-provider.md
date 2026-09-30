---
type: Convention
title: Companion provider (not Voyager domain)
description: probe keeps Venusian\Probe\ProbeServiceProvider and discovers via composer extra.venusian.providers — not a Voyager component.
tags: [convention, provider, discovery, companion]
generated: { by: claude-opus-5-5, at: "2026-09-30T00:00:00Z" }
status: draft
sources:
  - id: composer
    resource: composer.json
    title: extra.venusian.providers
  - id: provider
    resource: src/ProbeServiceProvider.php
    title: ProbeServiceProvider
---

# Rule

`venusian/probe` is a **companion** to `venusian/framework` 0.10, not a Voyager component under `Voyager\*`.[^composer]

Therefore:

1. It **owns** `Venusian\Probe\ProbeServiceProvider` in this package.[^provider]
2. Discovery uses Composer `extra.venusian.providers`, read by the app's `PackageManifest` on `package:discover`.[^composer]
3. Provider stays here, never in framework `DefaultProviders`.

# Related

- [Package](../orientation/package.md)
- [ProbeServiceProvider](../components/service-provider.md)

[^composer]: extra.venusian.providers
[^provider]: ProbeServiceProvider
