<style>
  .v38-updates-grid {
    display: grid;
    grid-gap: var(--spacing-6);
    grid-template-columns: 1fr;
    grid-template-areas: "figure"
      "box1"
      "box2";
  }

  @media screen and (min-width: 45rem) {
    .v38-updates-grid {
      grid-template-columns: 1fr 1fr;
      grid-template-areas: "figure figure"
        "box1 box2";
    }
  }
</style>

<section id="updates" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'New update checks',
    'subtitle' => 'Keep your installation healthy',
    'mb'       => 12
  ]) ?>

  <div class="v38-updates-grid">

    <figure class="release-box bg-light" style="--aspect-ratio: 1488/836; grid-area: figure">
      <img src="<?= $page->image('updates.png')?->url() ?>" loading="lazy" alt="The system view now shows available updates for Kirby and installed plugins">
    </figure>

    <div class="release-text-box" style="grid-area: box1">
      <h3>Always up to date</h3>
      <div class="prose">
        <p>Our new update check in the enhanced system view makes it easy to stay informed about the version and security status of Kirby and your installed plugins.</p>
        <p>While feature updates are not always needed for finished sites, keeping an eye on security issues and important security messages is really important to keep your sites secure and healthy.</p>
        <p>The new update check brings this information and more right into the Panel so you can get a quick overview of the status of your site.</p>
        <p>Fine-tuning the behavior is really simple:</p>
      </div>
    </div>
    <div class="release-code-box" style="grid-area: box2">
      <?= $page->updatesConfig()->kt() ?>
    </div>
  </div>

</section>
