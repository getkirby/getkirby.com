<div class="menu ml-auto">
  <input id="menu-check" type="checkbox">
  <label tabindex="0" class="menu-toggle" for="menu-check" aria-label="Show / hide menu">
    <?= icon('menu') ?>
  </label>
  <nav aria-label="Main menu">
    <ul class="menu-1">
      <li class="has-submenu">
        <a href="/features/developers">The CMS</a>
        <ul class="menu-2">
          <li><a href="/features/developers">For developers</a></li>
          <li><a href="/features/designers">For designers</a></li>
          <li><a href="/features/creators">For content creators</a></li>
          <li><a href="/features/clients">For clients & agencies</a></li>
          <li><a href="/love">Showcase</a></li>
        </ul>
      </li>
      <li class="has-submenu">
        <a href="/docs/guide">Docs</a>
        <ul class="menu-2">
          <li><a href="/docs/guide">Guide</a></li>
          <li><a href="/docs/cookbook">Cookbook</a></li>
          <li><a href="/docs/reference">Reference</a></li>
          <li><a class="is-external" href="https://youtube.com/kirbycasts">Screencasts</a></li>
          <li><a href="/docs/glossary">Glossary</a></li>
        </ul>
      </li>
      <li class="has-submenu">
        <a href="/kosmos">Resources</a>
        <ul class="menu-2">
          <li><a href="/kosmos">Newsletter</a></li>
          <li><a href="/plugins">Plugins</a></li>
          <li><a class="is-external" href="https://kirby.nolt.io/roadmap">Roadmap</a></li>
          <li><a class="is-external" href="https://github.com/getkirby/kirby/releases">Releases</a></li>
        </ul>
      </li>
      <li class="has-submenu">
        <a href="https://chat.getkirby.com">Community</a>
        <ul class="menu-2">
          <li><a class="is-external" href="https://feedback.getkirby.com">Feedback</a></li>
          <li><a class="is-external" href="https://forum.getkirby.com">Support forum</a></li>
          <li><a class="is-external" href="https://chat.getkirby.com">Discord chat</a></li>
          <li><a class="is-external" href="https://twitter.com/getkirby">Twitter</a></li>
          <li><a class="is-external" href="https://instagram.com/getkirby">Instagram</a></li>
        </ul>
      </li>
    </ul>
    <ul class="menu-1 menu-steps">
      <li><a href="/try">Try</a></li>
      <li>
        <a href="/love">
          <?= icon('heart') ?>
        </a>
      </li>
      <li>
        <a href="/buy">Buy</a>
      </li>
    </ul>
  </nav>
</div>
