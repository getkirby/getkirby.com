<div id="form" class="columns" style="--columns: 2; --gap: var(--spacing-1)">
  <form method="POST" action="<?= option('hub.url') . '/login' ?>" class="highlight bg-light flex flex-column justify-between">
    <header>
      <h2 class="h2 mb-6">Customers</h2>
      <div class="prose text-base mb-12">
        <p>
          If you are an existing customer, you can find a magic approval button in the email we sent you.
          If you didn't get the email, you can log in with your email address and an order ID to give your approval.
        </p>
      </div>
    </header>
    <footer>
      <div class="columns mb-12" style="--columns: 2">
        <p>
          <label for="email" class="color-black font-bold block mb-3">Email address</label>
          <input id="email" type="email" name="email" required class="input">
        </p>
        <p>
          <label for="order" class="color-black font-bold block mb-3">Order ID</label>
          <input id="order" type="password" name="order" required class="input">
        </p>
      </div>
      <input type="hidden" name="redirect" value="true">
      <button type="submit" class="btn btn--filled w-100%"><?= icon('key') ?> Login</button>
    </footer>
  </form>
  <form method="POST" action="#form" class="highlight bg-light flex flex-column justify-between">
    <header>
      <h2 class="h2 mb-6">Newsletter subscribers</h2>
      <div class="prose text-base mb-12">
        <p>
          As a <a class="link" href="<?= url('kosmos') ?>">newsletter subscriber</a> you have also received an email with a magic approval button to confirm your subscription.
          If you didn't get the email, you can (re)subscribe here.
        </p>
      </div>
    </header>
    <footer>
      <div class="columns mb-12" style="--columns: 2">
        <p>
          <label for="email" class="color-black font-bold block mb-3">Email address</label>
          <input id="email" type="email" name="email" required class="input">
        </p>
        <p>
          <label for="name" class="color-black font-bold block mb-3">Name (optional)</label>
          <input id="name" type="name" name="name" class="input">
        </p>
      </div>
      <button type="submit" class="btn btn--filled w-100%"><?= icon('flash') ?> Subscribe</button>
    </footer>
  </form>
</div>
