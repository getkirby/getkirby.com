<section id="kosmos" class="columns" style="--columns-md: 1; --columns: 2; --gap: var(--spacing-12)">
  <div class="columns" style="--columns-sm: 1; --columns-md: 2; --columns-lg: 1; --column-gap: var(--spacing-12)">
    <?php snippet('hgroup', [
      'title' => $title ?? 'Join the Kirby community!',
      'subtitle' => 'Subscribe to our <a class="link" href="/kosmos">monthly newsletter</a>. Enter our <a class="link" href="https://chat.getkirby.com">Discord chat</a>. Watch the <a class="link" href="https://youtube.com/kirbycasts">screencasts</a>. Follow us on <a class="link" href="https://twitter.com/getkirby">Twitter</a> and <a class="link" href="https://instagram.com/getkirby">Instagram</a> for the latest updates.',
      'mb' => 3
    ]) ?>

    <ul class="columns font-mono text-sm" style="--columns: 2; --columns-sm: 2;">
      <li>
        <a class="flex items-center" href="https://twitter.com/getkirby">
          <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('twitter') ?></figure>
          Twitter
        </a>
      </li>
      <li>
        <a class="flex items-center" href="https://youtube.com/kirbycasts">
          <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('youtube') ?></figure>
          Screencasts
        </a>
      </li>
      <li>
        <a class="flex items-center" href="https://chat.getkirby.com">
          <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('discord') ?></figure>
          Discord
        </a>
      </li>
      <li>
        <a class="flex items-center" href="https://instagram.com/getkirby" style="--icon: var(--color-blue-300)">
          <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('instagram') ?></figure>
          Instagram
        </a>
      </li>
    </ul>
  </div>

  <?php snippet('templates/kosmos/form') ?>
</section>
