<table>
    <tr><th>Affected versions</th><th style="width: 100%">Description</th><th>Fixed in</th></tr>
    
    <?php foreach ($incidents as $incident): ?>
    <tr>
        <td><code><?= $incident->affected()->escape() ?></code></td>
        <td title="severity: <?= $incident->severity() ?>" class="-color:<?= str_replace(['major', 'notable', 'minor'], ['red', 'orange', 'yellow'], $incident->severity()->value()) ?>">
            <?= $incident->description() ?>
        </td>
        <td>
            <a href="https://github.com/getkirby/kirby/releases/tag/<?= $incident->fixed() ?>">
                <?= $incident->fixed() ?>
            </a>
        </td>
    </tr>
    <?php endforeach ?>
</table>
