<style>
.trust-in-brands svg {
  width: 100%;
  max-height: 4.5rem;
  max-width: 9rem;
}
</style>

<section class="mb-42 columns features-xl">
  <div>
    <?php snippet('templates/features/intro', [
      'title' => 'Trusted by brands world-wide',
      'text'  => 'Tech, automobile, energy, food, fashion, health: leading brands around the world use Kirby for their digital solutions. Editorial systems, intranet solutions, factory terminals, mobile apps or just good old websites. They are in good hands with Kirby.'
    ]) ?>

    <ul class="columns" style="--columns-sm: 3; --columns: 3">
      <li>
        <span class="block text-2xl">40k+</span>
        <span class="font-mono text-xs"> sites</span>
      </li>
      <li>
        <span class="block text-2xl">3800+</span>
        <span class="font-mono text-xs"> forum users</span>
      </li>
      <li>
        <span class="block text-2xl">1300+</span>
        <span class="font-mono text-xs"> discord users</span>
      </li>
    </ul>

  </div>

  <ul class="trust-in-brands columns auto-rows-fr" style="--columns-sm: 2; --columns-md: 3; --columns: 3; --gap: var(--spacing-1)">
    <?php foreach(page('home/clients')->children()->listed()->shuffle() as $client): ?>
    <li class="bg-light p-6 flex items-center justify-center">
      <?= $client->image()->read() ?>
    </li>
    <?php endforeach ?>
  </ul>

</section>
