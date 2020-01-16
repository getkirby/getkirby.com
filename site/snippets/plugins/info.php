
<div class="grid">
  <div class="column text">
    <h2>Installation</h2>

    <ol>
      <li><a href="">Download 1.2.5</a></li>
      <li>Unzip the plugin</li>
      <li>Copy the plugin to <code>/site/plugins/<?= $page->slug() ?></code></li>
    </ol>

    <p>Alternatively, you can install it with <a href="">composer</a>:</p>
    <pre class="code"><code>composer require <?= $page->parent()->slug() . '/' . $page->slug() ?></code></pre>

    <p>… or as Git submodule</p>
    <pre class="code"><code>git submodule add <?= $page->repository() ?>.git site/plugins/<?= $page->slug() ?></code></pre>

  </div>

  <div class="column text">
    <h2>About this plugin</h2>

    <dl>
      <dt class="h6">Author</dt>
      <dd><a href=""><?= $page->parent()->title() ?></a></dd>

      <dt class="h6">Version</dt>
      <dd>1.2.5</dd>

      <dt class="h6">License</dt>
      <dd>MIT</dd>

      <dt class="h6">Requirements</dt>
      <dd>Kirby 3+</dd>
    </dl>
  </div>
</div>
