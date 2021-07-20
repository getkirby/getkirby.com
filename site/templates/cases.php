<?php layout() ?>

<style>
.header,
.footer h6 {
  color: var(--color-white);
}
.header .banner {
  color: initial;
}
html {
  background: var(--color-dark);
  color: var(--color-gray-400);
}
</style>

<article>

  <h1 class="h1 mb-12 color-white">Made with&nbsp;Kirby</h1>

  <div class="mb-12">
    <?php snippet('templates/cases/cases', [
      'cases' => collection('cases')->shuffle()
    ]) ?>
  </div>

  <footer class="h2">
    <h2>You built something with Kirby?</h2>
    <p class="color-white">
      Share your work in our <a class="link" href="https://forum.getkirby.com/t/made-with-kirby-and-3/83">forum</a>
    </p>
  </footer>

</article>
