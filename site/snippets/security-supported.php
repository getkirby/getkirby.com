<table>
    <tr><th>Kirby Version</th><th style="width: 100%">Support Status</th></tr>
    
    <?php foreach ($supported as $entry): ?>
    <tr>
        <td><code><?= $entry->version()->escape() ?></code></td>
        <td><?= $entry->description() ?></td>
    </tr>
    <?php endforeach ?>
</table>
