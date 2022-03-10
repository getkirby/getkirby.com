<!-- Form -->
<form id="form" method="POST" action="#form" class="form pt-6 mb-36">
  <header class="mb-3 flex flex-wrap justify-between items-baseline">
    <h2 class="h2 mb-3">Migrate your data</h2>
    <?php if ($email) : ?>
      <a href="<?= option('hub.url') ?>" class="form-account h6 mb-3 flex items-center">
        <strong class="mr-3">Account</strong>
        <figure class="mr-3"><?= icon('mail') ?></figure> <?= $email ?>
      </a>
    <?php endif ?>
  </header>

  <?php if (empty($error) === false) : ?>
    <div class="error">
      <ul>
        <?php foreach ($error as $e) : ?>
          <li><?= $e ?></li>
        <?php endforeach ?>
      </ul>
    </div>
  <?php endif ?>

  <div class="form-boxes mb-12" data-span="<?= $hasData && $hasNewsletter ? 'true' : 'false' ?>">
    <div class="form-box form-box-data" data-active="<?= $hasData ? 'true' : 'false' ?>">
      <div>
        <h3 class="h3 mb-6">Licenses and purchase history</h3>
        <div class="prose text-base">
          <?php if ($hasData) : ?>
            <p><mark>Please, migrate your licenses to <abbr title="Content Folder GmbH & Co. KG">our new company</abbr> and confirm that we may continue to access the same data.</mark></p>
          <?php else: ?>
            <p><mark>Nothing to do here. There are no licenses connected to your email address.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <div>
        <h3 id="eula-changes" class="h3 mb-6">Revised license agreement</h3>
        <div class="prose text-base">
          <?php if ($hasData) : ?>
            <p class="mb-6"><mark>We have adapted our license agreement to <abbr title="Content Folder GmbH & Co. KG">our new company</abbr> and clarified what it covers. Please, agree to our revised terms.</mark></p>
          <?php elseif ($email) : ?>
            <p class="mb-6"><mark>Nothing to do here. There are no licenses connected to your email address.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <?php if ($hasData) : ?>
        <footer>
          <label class="checkbox">
            <strong class="text-sm">
              <input type="checkbox" name="data" value="transfer" <?= get('data') === 'transfer' ? 'checked' : '' ?> class="mr-3">
              I agree to migrate my data and accept the revised license terms
            </strong>
          </label>
        </footer>
      <?php endif ?>
    </div>

    <div class="form-box form-box-kosmos" data-active="<?= $hasNewsletter ? 'true' : 'false' ?>">
      <div>
        <h3 class="h3 mb-6">Kosmos subscription</h3>
        <div class="prose text-base mb-12">
          <?php if ($hasNewsletter) : ?>
            <p><mark>We need your confirmation that you want to receive our monthly Kosmos newsletter from <abbr title="Content Folder GmbH & Co. KG">our new company</abbr> from now&nbsp;on.</mark></p>
          <?php else: ?>
            <p><mark>Receive our monthly newsletter issues. We won't ever spam you and you can unsubscribe at any given time.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <footer>
        <label class="checkbox">
          <strong class="text-sm">
            <input type="checkbox" name="newsletter" value="subscribe" <?= get('newsletter') === 'subscribe' ? 'checked' : '' ?> class="mr-3">
            <?= $hasNewsletter ? 'I agree to keep my subscription' : 'I want the newsletter' ?>
          </strong>
        </label>
        <input type="hidden" name="email" value="<?= esc($email) ?>">
        <input type="hidden" name="hash" value="<?= esc($hash) ?>">
      </footer>
    </div>
  </div>

  <div class="text-center" style="--span: 3">
    <button class="btn btn--filled">
      <?= icon('check') ?> Submit
    </button>
  </div>

</form>

<script>
  const form = document.querySelector("#form");
  form.addEventListener("submit", (e) => {
    const checked = form.querySelectorAll("[type=checkbox]:checked").length !== 0;

    if (checked === false) {
      e.preventDefault();
      alert("You didn’t make a selection. That’s totally fine. There’s just no need to submit the form in this case.");
    }
  });
</script>
