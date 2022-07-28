<style>
.security-incidents.table table {
  min-width: 36rem;
}
.security-incidents td,
.security-incidents th {
  font-size: var(--text-sm);
}

.affected-column {
  width: 15%;
}
</style>

<div class="table security-incidents">
  <table>
    <tr>
      <th class="affected-column">Affected</th>
      <th class="w-100%">Description</th>
      <th>Severity</th>
      <th>CVE ID</th>
      <th>Fixed in</th>
    </tr>
    <?php foreach ($incidents as $incident): ?>
    <tr>
      <td>
        <?= $incident->affected()->escape() ?>
      </td>
      <td>
        <?= $incident->description() ?>

        <?php if ($incident->link()->isNotEmpty()): ?>
        <a class="whitespace-nowrap" href="<?= $incident->link() ?>">Read more ›</a>
        <?php endif ?>
      </td>
      <td>
        <?php if ($incident->cvss()->isNotEmpty()): ?>
        <a href="https://www.first.org/cvss/calculator/3.1#<?= $incident->cvss() ?>"><?= $incident->severity() ?></a>
        <?php else: ?>
        <?= $incident->severity() ?>
        <?php endif ?>
      </td>
      <td>
        <?php if ($incident->cve()->isNotEmpty()): ?>
        <a class="whitespace-nowrap" href="https://cve.mitre.org/cgi-bin/cvename.cgi?name=<?= $incident->cve() ?>"><?= $incident->cve() ?></a>
        <?php else: ?>
        CVE ID pending
        <?php endif ?>
      </td>
      <td>
        <?php foreach ($incident->fixed()->split(',') as $version): ?>
        <?php $major = Str::before($version, '.'); $majorOrg = $major !== '3' ? '-v' . $major : '' ?>
        <a href="https://github.com/getkirby<?= $majorOrg ?>/kirby/releases/tag/<?= $version ?>">
          <?= $version ?>
        </a>
        <?php endforeach ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</div>
