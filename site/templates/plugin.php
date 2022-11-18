<?php layout('plugins') ?>

<style>
  .plugin-summary {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: var(--spacing-6)
  }

  @media screen and (min-width: 65rem) {
    .plugin-summary {
      grid-template-columns: 1fr 14rem;
    }
  }

  .plugin-author img {
    border-radius: 100%;
    width: 3rem;
  }

  .plugin-author {
    margin-bottom: 1.5rem;
    border-radius: var(--rounded);
  }

  .plugin-links .btn {
    margin-bottom: 2px;
    width: 100%;
    justify-content: left;
    padding: 0;
    overflow: hidden;
    background: var(--color-light);
    border: 0;
    border-radius: var(--rounded);
  }

  .plugin-links .btn span {
    width: 2.25rem;
    height: 2rem;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    margin-right: .75rem;
    background: rgba(0, 0, 0, .025);
  }

  .plugin-links .btn svg {
    margin: 0;
  }

  .plugin-installation {
    border: 0;
    border-radius: .5rem;
    box-shadow: var(--shadow-xl);
    width: 40rem;
    margin: auto;
    background: var(--color-dark);
    color: white;
  }

  .plugin-installation form>header {
    padding: .75rem 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, .1);
    display: flex;
    justify-content: space-between;
  }

  .plugin-installation form>div {
    padding: 1.5rem;
  }

  .plugin-installation-box {
    background: #000;
    font-family: var(--font-mono);
    font-size: var(--text-xs);
    color: #fff;
    padding: .75rem;
    border-radius: .25rem;
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .5rem;
  }

  .plugin-installation-box input {
    font: inherit;
    border: 0;
    background: none;
    color: inherit;
    width: 100%;
    flex-grow: 1;
  }

  .plugin-installation-box a,
  .plugin-installation-box button {
    display: inline-flex;
    background: var(--color-orange-500);
    padding: .25rem .75rem;
    gap: .5rem;
    color: black;
    border-radius: .125rem;
    flex-shrink: 0;
  }

  .plugin-installation-box a svg,
  .plugin-installation-box button svg {
    flex-shrink: 0;
  }

  .plugin-installation input:focus {
    outline: 0;
  }
</style>

<article>

  <header class="mb-<?= $page->text()->isNotEmpty() ? '24' : '42' ?>">
    <h1 class="h1 block mb-12"><?= $page->title() ?></h1>
    <div class="plugin-summary mb-12">
      <figure>
        <div class="bg-light rounded overflow-hidden shadow-xl mb-6" style="--aspect-ratio: 2/1">
          <?php if ($card = $page->card()) : ?>
            <img src="<?= $card->url() ?>">
          <?php elseif ($page->example()->isNotEmpty()) : ?>
            <div class="bg-black" style="--aspect-ratio: 2/1">
              <div class="flex items-center justify-center">
                <div class="shadow-xl" data-no-copy><?= $page->example()->kt() ?></div>
              </div>
            </div>
          <?php elseif ($logo = $page->logo()) : ?>
            <div class="bg-light" style="--aspect-ratio: 2/1">
              <div class="flex items-center justify-center">
                <div style="height: 66%; --aspect-ratio: 1/1">
                  <img src="<?= $logo->url() ?>" style="object-fit: scale-down; mix-blend-mode: multiply">
                </div>
              </div>
            </div>
          <?php else : ?>
            <div class="block" style="--aspect-ratio: 2/1">
              <span>
                <span class="grid place-items-center" style="height: 100%">
                  <?= icon($page->icon()) ?>
                </span>
              </span>
            </div>
          <?php endif ?>
        </div>
        <figcaption class="prose text-xl color-black">
          <?= $page->description()->kt()->widont() ?>
        </figcaption>
      </figure>
      <nav aria-label="Plugin links" class="plugin-links">
        <a href="<?= $author->url() ?>" class="plugin-author flex flex-column items-center bg-light font-mono text-sm p-6">
          <?php if ($avatar = $author->avatar()) : ?>
            <img class="mb-3 shadow-xl" style="--aspect-ratio: 1/1" src="<?= $avatar->url() ?>">
          <?php endif ?>
          <?= $author->title() ?>
        </a>

        <?php if ($page->installation()->isTrue()) : ?>
          <button class="btn" onclick="document.querySelector('#installation').showModal()">
            <span><?= icon('flash') ?></span> Install
          </button>

          <dialog class="plugin-installation" id="installation" onclick="if (event.target === this) this.close()">
            <form method="dialog">
              <header>
                <h2 class="font-bold">Installation</h2>
                <button><?= icon('cross') ?></button>
              </header>
              <div>
                <h3 class="h6 mb-3">Manual</h3>
                <div class="plugin-installation-box mb-6">
                  <a href="<?= $download ?>">
                    <?= icon('download') ?> Download
                  </a>
                  and extract the folder to site/plugins/<?= $page->folder()->or($page->slug()) ?>
                </div>

                <?php if ($page->composer()->isNotEmpty()) : ?>
                  <h3 class="h6 mb-3">Composer</h3>
                  <div class="plugin-installation-box mb-6">
                    <input id="composer" readonly type="text" value="composer require <?= $page->composer() ?>" onclick="this.select()">
                    <button type="button" onclick="document.querySelector('#composer').select(); document.execCommand('copy')">
                      <?= icon('copy') ?> Copy
                    </button>
                  </div>
                <?php endif ?>

                <h3 class="h6 mb-3">Git Submodule</h3>
                <div class="plugin-installation-box">
                  <input id="git-submodule" readonly type="text" value="git submodule add <?= $page->submodule()->or($page->repository() . '.git') ?> site/plugins/<?= $page->folder()->or($page->slug()) ?>" onclick="this.select()">
                  <button type="button" onclick="document.querySelector('#git-submodule').select(); document.execCommand('copy')">
                    <?= icon('copy') ?> Copy
                  </button>
                </div>
              </div>
            </form>
          </dialog>
        <?php endif ?>

        <?php if ($page->repository()->isNotEmpty()) : ?>
          <a class="btn" href="<?= $page->repository() ?>">
            <span><?= icon('github') ?></span> Source
          </a>
        <?php endif ?>

        <?php if ($page->demo()->isNotEmpty()) : ?>
          <a class="btn" href="<?= url($page->demo()) ?>">
            <span><?= icon('play') ?></span> Demo
          </a>
        <?php endif ?>

        <?php if ($version = $page->version()) : ?>
          <a class="btn" href="<?= $download ?>">
            <span><?= icon('git') ?></span> <?= $version ?>
          </a>
        <?php endif ?>

        <?php if ($license = $page->license()) : ?>
          <a class="btn" href="<?= $page->license()->url() ?>">
            <span><?= icon('file') ?></span> <?= $page->license()->name() ?>
          </a>
        <?php endif ?>

        <a class="btn" href="<?= $download ?>">
          <span><?= icon('download') ?></span> Download
        </a>

      </nav>
    </div>

  </header>

  <?php if ($page->text()->isNotEmpty()) : ?>
    <?php snippet('toc', ['title' => 'Documentation']) ?>
    <div class="prose text-base mb-42">
      <?= $page->text()->kt() ?>
    </div>
  <?php endif ?>

  <?php if ($relatedPlugins->count()) : ?>
    <section class="mb-42">
      <h2 class="h2 mb-6">Related plugins</h2>
      <?php snippet('templates/plugins/cards', ['plugins' => $relatedPlugins, 'headingLevel' => 'h3']) ?>
    </section>
  <?php endif ?>

  <?php if ($authorPlugins->count()) : ?>
    <section class="mb-42">
      <h2 class="h2 mb-6">Other plugins by <a href="<?= $author->url() ?>" class="link"><?= $author->title() ?></a></h2>
      <?php snippet('templates/plugins/cards', ['plugins' => $authorPlugins, 'headingLevel' => 'h3']) ?>
    </section>
  <?php endif ?>

</article>
