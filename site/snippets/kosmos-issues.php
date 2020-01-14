<ul class="kosmos-issues">
  <?php foreach($issues as $issue): ?>
    <li class="kosmos-issue">
      <a href="<?= $issue->url() ?>">

        <figure>
          <?php if ($image = $issue->image()): ?>
          <?= $image->crop(300, 200) ?>
          <?php endif ?>
        </figure>

        <h4 class="h3 | -mb:0 -color:yellow-on-dark"><?= $issue->slug() ?></h4>
        <p class="h6 | -mb:small"><?= $issue->date('F jS, Y') ?></p>
        <?php
          $excerpt = substr($issue->text()->value(), 0, 250);
          $excerpt = explode(' ', $excerpt);
          $excerpt = '<b>' . implode('</b> <b>', $excerpt) . '</b>';
        ?>
        <p class="kosmos-issue-excerpt" aria-hidden="true"><?= $excerpt ?></p>
      </a>
    </li>
  <?php endforeach ?>
</ul>
