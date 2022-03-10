<form action="https://newsletter.getkirby.com/app/sub/" method="post" class="kosmos-form highlight bg-light">
  <div class="kosmos-fields">
    <input type="hidden" name="gruppe" value="<?= option('newstroll.list') ?>">
    <div class="kosmos-field">
      <label class="h5 mb-3 block" for="email">Email <small>(required)</small></label>
      <input class="input mb-3" id="email" name="email" required type="email">
      <p class="text-sm">By subscribing you agree that we send you monthly newsletters. We won't ever spam you! You can unsubscribe at any time.</p>
    </div>
    <div class="kosmos-field">
      <label class="h5 mb-3 block" for="name">Name</label>
      <input class="input mb-3" id="name" name="name" type="text">
      <p class="text-sm">We use the German company Newstroll to collect subscribers and send out newsletters. Find out more in our <a class="underline" href="<?= url('privacy#newsletter') ?>">privacy policy</a>.</p>
    </div>
    <div class="hidden">
      <label for="email_confirm">Field for spam protection, please leave it empty.</label>
      <input id="email_confirm" name="email_confirm" type="email">
    </div>
    <div class="kosmos-field">
      <button class="btn btn--filled w-100%">
        <?= icon('flash') ?>
        Subscribe
      </button>
    </div>
  </div>
</form>
