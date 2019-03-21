
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
          </div>

          <nav class="footer-menu">
            <ul>
              <li>
                <a class="h5" href="<?= url('docs') ?>">Docs</a>
                <ul>
                  <?php foreach (page('docs')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <li>
                <a class="h5" href="<?= url('community') ?>">Community</a>
                <ul>
                  <?php foreach (page('community')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <li>
                <a class="h5" href="<?= url('news') ?>">News</a>
                <ul>
                  <?php foreach (page('news')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
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
