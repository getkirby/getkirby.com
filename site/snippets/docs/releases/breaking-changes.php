<info>
We try to avoid breaking changes as much as we can. But we also put a lot of effort in keeping our technical debt in Kirby as low as possible. Sometimes such breaking changes are necessary to move forward with a clean code base.

You might wonder why there are breaking changes in a minor release according to [Semantic Versioning](https://semver.org).

We stick to the (link: docs/guide/quickstart#updates text: following versioning scheme):

```
{generation}.{major}.{minor}(.{patch})
```

**This release is Kirby 3.<?= $version ?>.0.0** (major release <?= $version ?> of Kirby 3)

Traditionally, we combine patch and minor releases though and only need the fourth versioning level for regression fixes.
</info>
