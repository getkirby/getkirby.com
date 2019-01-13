<?php snippet('header') ?>

  <main class="search-page | main" id="maincontent">

    <div class="wrap">

      <?php snippet('hero') ?>

      <!-- # Search Form -->

      <div class="search-controls | -mb:medium">

        <form class="search-form" role="search" action="<?= $page->url() ?>">
          <div class="search-field / js-search-field">

            <input type="search" autofocus class="search-input" name="q" id="q" placeholder="Search …" value="<?= $query ?>">

            <button class="search-submit | button-reset" value="Search">
              <?php icon('search') ?>
            </button>

          </div>

          <?php if(!empty($query)): ?>
            <p class="search-results-count description">
              <?php if($results->totalCount() !== 1): ?>
                <?= $results->totalCount() ?> results
              <?php else: ?>
                1 result
              <?php endif ?>
            </p>
          <?php endif ?>

        </form>

        <?php if(empty($query)): ?>
        <div class="search-suggestions | text">
          <h2 class="h3 -mb:0">Suggestions …</h2>
          <div class="description">
            <ul>
              <li>Search for object methods. i.e. <a href="<?= u('search') ?>?q=$site">$site</a>, <a href="<?php echo url('search') ?>?q=$page">$page</a> or <a href="<?= u('search') ?>?q=$file">$file</a></li>
              <li>All about <a href="<?= u('search') ?>?q=blueprint">blueprints</a></li>
              <li>List all <a href="<?= u('search') ?>?q=helpers">helper methods</a></li>
              <li><a href="<?= u('search') ?>?q=fields">Panel fields</a></li>
            </ul>
          </div>
        </div>
        <?php endif ?>

      </div>

      <!-- # Search Results -->

      <div class="search-results">

        <ol start="<?= $startNumber ?>">
          <?php foreach($results as $result): ?>
            <li class="search-result">
              <a href="<?= url($result->objectID()) ?>">
                <strong class="block"><span><?= $result->title() ?></span><span class="screen-reader-text">:</span></strong><br class="hide-if-css">
                <small class="description">
                  <?= $result->objectID() ?>
                </small>
                <aside>
                  <?= ucfirst($result->area()) ?>
                </aside>
              </a>
            </li>
          <?php endforeach ?>
        </ol>

      </div>

      <!-- # Pagination -->

      <?php if(!empty($query)): ?>
        <?php snippet('pagination', $results->pagination()) ?>
      <?php endif ?>

    </div>
  </main>

<?php snippet('footer') ?>
