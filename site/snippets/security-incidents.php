<table>
    <tr><th>Affected versions</th><th style="width: 100%">Description</th><th>Fixed in</th></tr>
    
    <?php foreach ($incidents as $incident): ?>
    <tr class="security-incident">
        <td><code><?= $incident->affected()->escape() ?></code></td>
        <td class="security-incident-details">
            <span title="severity: <?= $incident->severity() ?>" class="-color:<?= str_replace(['major', 'notable', 'minor'], ['red', 'orange', 'yellow'], $incident->severity()->value()) ?>">
                <?= $incident->description() ?>
            </span>
            
            <?= $incident->cve()->or('<em>CVE reference pending</em>') ?>

            <?php if ($incident->cve()->isNotEmpty()): ?>
            <a href="https://cve.mitre.org/cgi-bin/cvename.cgi?name=<?= $incident->cve() ?>">CVE Entry</a>
            <?php endif ?>

            <?php foreach ($incident->links()->yaml() as $title => $link): ?>
            <a href="<?= $link ?>"><?= $title ?></a>
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
