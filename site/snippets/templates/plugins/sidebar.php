<nav aria-label="Plugins menu">
  <div class="sticky" style="--top: var(--spacing-6)">
    <?php slot('hero') ?>
    <p class="h1 mb-12 color-gray-400"><a href="/plugins">Plugins</a></p>
    <?php endslot() ?>
    <ul class="filters">
      <li>
        <button class="search-button" type="button" data-area="plugin">
          <?= icon('search') ?> Search
        </button>
      </li>
      <li>
        <hr class="hr">
      </li>
      <li>
        <a href="/plugins/category:all" <?= ariaCurrent($currentCategory === 'all') ?>>
          <?= icon('list') ?> All
        </a>
      </li>
      <!-- Skip featured plugins for now …
			<li>
        <a href="/plugins" <?= ariaCurrent((!$currentCategory) && in_array($kirby->request()->path()->toString(), ['plugins/new', 'plugins/getkirby']) === false) ?>>
          <?= icon('star') ?> Featured
        </a>
      </li> -->
      <li>
        <a href="/plugins/k4" <?= ariaCurrent($kirby->request()->path()->toString() === 'plugins/k4') ?>>
          <?= icon('flash') ?> Kirby 4
        </a>
      </li>
      <li>
        <a href="/plugins/getkirby" <?= ariaCurrent($kirby->request()->path()->toString() === 'plugins/getkirby')  ?>>
          <?= icon('kirby') ?> Official
        </a>
      </li>
      <li>
        <button class="search-button" type="button" data-area="plugin">
          <?= icon('search') ?> Search
        </button>
      </li>
      <li>
        <hr class="hr">
      </li>
      <?php foreach ($categories as $categoryId => $category) : ?>
        <li>
          <a aria-label="<?= $category['label'] ?> plugins" href="/plugins/category:<?= $categoryId ?>" <?= ariaCurrent($categoryId === $currentCategory) ?>>
            <?= icon($category['icon']) ?> <?= $category['label'] ?>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</nav>
