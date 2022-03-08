<!-- Form -->
<form id="form" method="POST" action="#form" class="form pt-6 mb-24">
  <header class="mb-6 flex justify-between items-baseline">
    <h2 class="h2">Your data</h2>
    <?php if ($email) : ?>
      <a href="<?= option('hub.url') ?>" class="h6 flex items-center">
        <strong class="mr-3">Your account</strong>
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
        <h3 class="h3 mb-6">License data and purchase history</h3>
        <div class="prose text-base">
          <p>If you purchased a license, we store your email address, license keys and registered domains on our license server. We also have access to your invoice data from Paddle.</p>
          <?php if ($hasData) : ?>
            <p><mark>Please transfer your license(s) to the Content Folder GmbH & Co. KG and confirm that we may continue to access the same data with the new company.</mark></p>
          <?php elseif ($email) : ?>
            <p><mark>Nothing to do here. There are no licenses connected to your email address.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <div>
        <h3 id="eula-changes" class="h3 mb-6">Revised license agreement (EULA)</h3>
        <div class="prose text-base">
          <p class="mb-6">We have adapted our EULA to the new company and used the opportunity to more clearly define what the license covers.</p>
          <details>
            <summary class="color-black"><span class="link">What has changed and why?</span></summary>
            <div class="text-sm pt-6">
              <p>We based the changes to our license agreement (EULA) on feedback we received in the last months. Our goal is to give you and your clients more legal certainty. Nothing changes in practice for paid licenses, but now your rights are written in black and white. At the same time we have clarified ambiguous parts of the EULA.</p>
              <p>In particular, we have changed the following:</p>

              <ul>
                <li>The licensor is now the <span class="whitespace-nowrap">Content Folder GmbH &amp; Co. KG</span>.</li>
                <li>We explicitly grant you more rights for working with Kirby. I.e. you may make copies of Kirby for the purpose of deployment or development, use Kirby with or for third parties in defined cases and use the MIT-licensed parts of the code for other projects.</li>
                <li>We explicitly state that you have the right to transfer licenses by requesting the transfer from us.</li>
                <li>The EULA now has a specific list of disallowed uses instead of a blanket statement that allowed us to determine if a use qualified under the agreement.</li>
                <li>We have clarified the definition of cross-domain multi-language installations that only need a single license.</li>
                <li>We have clarified that headless or static sites built or generated with Kirby are defined by their frontend domain and root directory.</li>
                <li>For an easier understanding we have renamed the term "Development Machine" to "Internal Site" and clarified that an Internal Site must not be accessible by the public.</li>
                <li>It is no longer possible to use Kirby for free in an intranet. The free use for development or for personal or family apps on a personal computer or home server is still allowed.</li>
                <li>We specified that changes to the EULA that constrain your rights to a great extent require your approval. A termination of the agreement only requires the textual form instead of a written letter and can be declared for particular licenses.</li>
                <li>We clarified that the license restrictions and the warranty exclusion also apply to free licenses and to users who are not a licensee.</li>
                <li>We defined that only German law applies to the EULA and that the place of jurisdiction is Germany.</li>
                <li>We added a severability clause to avoid that licenses become void if only a part of the EULA turns out to be invalid.</li>
                <li>We have reworded some sentences to make them easier to read and understand or to fix typos. We have also made minor changes that don't change the general meaning of the EULA.</li>
              </ul>
              <p>Check out the <a class="link" href="/license">revised license agreement</a>. You can also take a look at the <a class="link" href="/license/2022-03-10?diff">full set of changes</a>.</p>
            </div>
          </details>
          <?php if ($hasData) : ?>
            <p><mark>For the revised license terms we need your approval.</mark></p>
          <?php elseif ($email) : ?>
            <p><mark>Nothing to do here. There are no licenses connected to your email address.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <?php if ($hasData) : ?>
        <footer>
          <label class="checkbox">
            <strong class="text-sm">
              <input type="checkbox" name="data" value="transfer" <?= get('data') === 'transfer' ? 'checked' : '' ?> class="mr-3">
              I agree to transfer my data and accept the revised license terms
            </strong>
          </label>
          <div class="columns">
            <p class="prose text-sm"><span class="color-black">If you don‘t agree to transfer your data</span>, you will stay a customer of the Bastian Allgeier GmbH for now. We won't be able to provide full support for your licenses going forward.</p>
            <p class="prose text-sm"><span class="color-black">If you don‘t agree to the revised license terms</span>, the previous terms will still be valid for your licenses. You can agree to the new terms and transfer your licenses to the new company at any time.</p>
          </div>
        </footer>
      <?php endif ?>
    </div>

    <div class="form-box form-box-kosmos" data-active="<?= $hasNewsletter ? 'true' : 'false' ?>">
      <div>
        <h3 class="h3 mb-6">Kosmos subscription</h3>
        <div class="prose text-base mb-12">
          <p>Sonja will keep providing Kirby community highlights and the latest web development news in our monthly Kosmos newsletter.</p>
          <?php if ($hasNewsletter) : ?>
            <p><mark>We need your confirmation that you want to receive our Kosmos newsletter from the Content Folder GmbH & Co. KG from now&nbsp;on.</mark></p>
          <?php elseif ($email) : ?>
            <p><mark>You are not yet subscribed with this&nbsp;address.</mark></p>
          <?php endif ?>
        </div>
      </div>
      <footer>
        <?php if ($email) : ?>
          <label class="checkbox">
            <strong class="text-sm">
              <input type="checkbox" name="newsletter" value="subscribe" <?= get('newsletter') === 'subscribe' ? 'checked' : '' ?> class="mr-3">
              <?= $hasNewsletter ? 'I agree to keep my subscription' : 'I want the newsletter' ?>
            </strong>
          </label>
          <input type="hidden" name="email" value="<?= esc($email) ?>">
          <input type="hidden" name="hash" value="<?= esc($hash) ?>">
        <?php else : ?>
          <p class="mb-6">
            <label for="email" class="color-black font-bold block mb-1">Your email address</label>
            <input id="email" type="email" name="email" class="input">
          </p>
        <?php endif ?>
        <?php if ($hasNewsletter) : ?>
          <p class="prose text-sm">Otherwise you will <em>not</em> receive our Kosmos newsletter in the future. We have unsubscribed all previous subscribers.<br><br></p>
        <?php else : ?>
          <p class="prose text-sm">Check out our <a class="link" href="/kosmos">Kosmos archive</a> for past issues. We won't ever spam you and you can unsubscribe at any given time.<br><br></p>
        <?php endif ?>
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
