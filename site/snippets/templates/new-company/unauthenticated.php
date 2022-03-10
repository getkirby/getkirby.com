
<div id="form" class="columns mb-24" style="--columns: 2; --gap: var(--spacing-1)">
  <form method="GET" action="<?= option('hub.url') . '/login' ?>" class="highlight bg-white shadow-xl flex flex-column justify-between">
    <header>
      <h2 class="h2 mb-6">Customers</h2>
      <div class="prose mb-12">
        <p>
          <mark>If you are an existing customer, you can find a magic approval button in the email we sent you.</mark>
        </p>
        <p>
          If you didn't get the email, you can log in to our brand new customer hub for approval.
        </p>
      </div>
    </header>
    <footer>
      <input type="hidden" name="redirect" value="true">
      <button type="submit" class="btn btn--filled"><?= icon('key') ?> Login</button>
    </footer>
  </form>
  <form method="POST" action="https://newsletter.getkirby.com/app/sub/" class="highlight bg-light flex flex-column justify-between">
    <header>
      <h2 class="h2 mb-6">Newsletter</h2>
      <div class="prose mb-12">
        <p>Sonja will keep providing Kirby community highlights and the latest web development news in our monthly <a class="link whitespace-nowrap" href="<?= url('kosmos') ?>">Kosmos newsletter</a>. Add yourself to the list if you are not subscribed yet.</p>
      </div>
    </header>
    <footer>
      <div class="columns mb-3" style="--columns-md: 1; --columns: 2">
        <p>
          <label for="email" class="color-black font-bold block mb-3">Email address</label>
          <input id="email" type="email" name="email" required class="input">
        </p>
        <p class="hidden">
          <label for="email_confirm">Field for spam protection, please leave it empty.</label>
          <input id="email_confirm" name="email_confirm" type="email">
        </p>
        <p>
          <label for="name" class="color-black font-bold block mb-3">Name (optional)</label>
          <input id="name" type="name" name="name" class="input">
        </p>
      </div>
      <p class="text-sm mb-12">We won't ever spam you! You can unsubscribe at any&nbsp;time.</p>
      <input type="hidden" name="gruppe" value="<?= option('newstroll.list') ?>">
      <button type="submit" class="btn btn--filled"><?= icon('flash') ?> Subscribe</button>
    </footer>
  </form>
</div>
