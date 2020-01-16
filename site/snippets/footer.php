
    <footer class="footer -theme:<?= $theme ?? 'white' ?>">
      <div class="wrap">
        <div class="footer-layout">
          <div class="footer-colophon">
            <p class="footer-wordmark">
              <a class="h1" href="<?= u() ?>">
                Kirby
              </a>
            </p>
            <p class="footer-copyright">
              <a href="<?= u('contact') ?>">
                &copy; Copyright 2012&thinsp;–&thinsp;<?= date('Y') ?><br>
                Bastian Allgeier GmbH<br>
              </a>
            </p>
            <nav class="footer-social">
              <a href="https://twitter.com/getkirby"><?= icon('twitter') ?></a>
              <a href="https://instagram.com/getkirby"><?= icon('instagram') ?></a>
              <a href="https://github.com/getkirby"><?= icon('github') ?></a>
            </nav>
          </div>

          <nav class="footer-menu">
            <ul>
              <?php foreach(['docs', 'resources', 'news'] as $section) : ?>
              <?php if ($section = page($section)) : ?>
              <li>
                <a class="h5" href="<?= $section->url() ?>"><?= $section->title() ?></a>
                <ul>
                  <?php foreach ($section->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <?php endif ?>
              <?php endforeach ?>
              <li>
                <a class="h5" href="<?= url('contact') ?>">Misc</a>
                <ul>
                  <li><a href="<?= url('privacy') ?>">Privacy</a></li>
                  <li><a href="<?= url('license') ?>">License</a></li>
                  <li><a href="<?= url('contact') ?>">Contact</a></li>
                  <li><a href="<?= url('press') ?>">Presskit</a></li>
                </ul>
              </li>
              <li>
                <span class="h5">Partners</span>
                <ul class="footer-partners">
                  <li><a href="https://algolia.com" aria-label="Algolia"><?= icon('algolia') ?></a></li>
                  <li><a href="https://keycdn.com" aria-label="KeyCDN"><?= icon('keycdn') ?></a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </footer>

  </body>
</html>
