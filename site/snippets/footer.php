
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
              <a href="https://youtube.com/kirbycasts"><?= icon('youtube') ?></a>
              <a href="https://discord.gg/guMqMfJ"><?= icon('discord') ?></a>
            </nav>
          </div>

          <nav class="footer-menu">
            <ul>
              <li>
                <a class="h5" href="<?= url('docs') ?>">Product</a>
                <ul>
                  <?php foreach (page('product')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <li>
                <a class="h5" href="<?= url('docs') ?>">Docs</a>
                <ul>
                  <?php foreach (page('docs')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <li>
                <a class="h5" href="<?= url('resources') ?>">Resources</a>
                <ul>
                  <?php foreach (page('resources')->children()->listed() as $item): ?>
                  <li><?= $item->title()->link() ?></li>
                  <?php endforeach ?>
                </ul>
              </li>
              <li>
                <a class="h5" href="<?= url('contact') ?>">Misc</a>
                <ul>
                  <li><a href="<?= url('https://forum.getkirby.com') ?>">Forum</a></li>
                  <li><a href="<?= url('https://feedback.getkirby.com') ?>">Feedback</a></li>
                  <li><a href="<?= url('security') ?>">Security</a></li>
                  <li><a href="<?= url('privacy') ?>">Privacy</a></li>
                  <li><a href="<?= url('license') ?>">License</a></li>
                  <li><a href="<?= url('contact') ?>">Contact</a></li>
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
