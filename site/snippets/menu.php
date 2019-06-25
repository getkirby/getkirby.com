<nav class="menu<?= r(!empty($background), ' background:' . $background) ?>">

  <button class="button-reset menu-toggle"
          aria-label="Open menu"
          aria-controls="menu"
          aria-expanded="false">
    <i></i>
    <i></i>
    <i></i>
  </button>

  <div class="menu-container" id="menu">
    <ul class="menu-items menu-main">
      <?php foreach ($pages->listed() as $item): ?>
      <li class="menu-item<?= r($hasSubmenu = $item->submenu()->isTrue(), ' has-dropdown') ?>">
        <a href="<?= $item->url() ?>"<?= r($item->isOpen(), ' aria-current="' . r($item->isActive(), 'page', 'true') . '"') ?>>
          <?= $item->menuTitle()->or($item->title()) ?>
        </a>

        <?php if ($hasSubmenu): ?>
        <ul class="menu-dropdown">
          <?php foreach ($item->children()->listed() as $subitem): ?>
          <li>
            <a href="<?= $subitem->url() ?>"<?= r($subitem->isActive(), ' aria-current="page"') ?>>
              <?= $subitem->menuTitle()->or($subitem->title()) ?>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </li>
      <?php endforeach ?>
    </ul>

    <ul class="menu-items menu-trylovebuy">
      <?php foreach (pages('try', 'love', 'buy') as $item): ?>
      <li class="menu-item">
        <a href="<?= $item->url() ?>" <?= r($item->isActive(), ' aria-current="page"') ?>>
          <?php if ($item->id() === 'love'): ?>
          <svg width="18" height="18" viewBox="0 0 18 18">
            <title>Love</title>
            <path d="M15.6822088,3.31777353 C13.9251539,1.56074216 11.0750648,1.56074216 9.31800994,3.31777353 C9.19700616,3.43877569 9.10400325,3.57677816 9,3.70678048 C8.89599675,3.57677816 8.80299384,3.43877569 8.68199006,3.31777353 C6.92493515,1.56074216 4.07484609,1.56074216 2.31779118,3.31777353 C0.560736273,5.07480491 0.560736273,7.9248558 2.31779118,9.68188718 L9,16 L15.6822088,9.68188718 C17.4392637,7.9248558 17.4392637,5.07480491 15.6822088,3.31777353 Z"></path>
          </svg>
          <?php else: ?>
            <?= $item->menuTitle()->or($item->title()) ?>
          <?php endif ?>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
  </div>

</nav>
