<style>
.security-incidents.table table {
  min-width: 36rem;
}
.security-incidents td,
.security-incidents th {
  font-size: var(--text-sm);
}
</style>

<div class="table security-incidents">
  <table>
    <tr>
      <th>Affected</th>
      <th class="w-100%">Description</th>
      <th>Severity</th>
      <th>Details</th>
      <th>Fixed in</th>
    </tr>
    <?php foreach ($incidents as $incident): ?>
    <tr>
      <td>
        <?= $incident->affected()->escape() ?>
      </td>
      <td>
        <?= $incident->description() ?>
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
        CVE pending
        <?php endif ?>
        <br>

        <?php foreach ($incident->links()->value() as $name => $url): ?>
        <a class="whitespace-nowrap" href="<?= $url ?>"><?= $name ?></a>
        <?php endforeach ?>
      </td>
      <td>
        <a href="https://github.com/getkirby/kirby/releases/tag/<?= $incident->fixed() ?>">
          <?= $incident->fixed() ?>
        </a>
      </td>
    </tr>
    <?php endforeach ?>
  </table>
</div>
