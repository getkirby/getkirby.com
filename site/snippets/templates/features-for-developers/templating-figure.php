<style>
.template-select {
  background: none;
}
</style>

<select aria-label="Switch the template engine example" class="template-select mb-3">
  <option value="php" selected>PHP template</option>
  <option value="twig">Twig template</option>
  <option value="blade">Blade template</option>
</select>

<div id="php" data-templating>
  <?= $page->phpTemplate()->kt() ?>
</div>
<div id="twig" data-templating class="hidden">
  <div class="mb-3">
    <?= $page->twigTemplate()->kt() ?>
  </div>
  <div class="font-mono text-xs color-gray-700">
    <a href="/plugins/mgfagency/twig"><strong class="font-normal color-black link">Kirby Twig plugin</strong> by Christian Zehetner</a>
  </div>
</div>
<div id="blade" data-templating class="hidden">
  <div class="mb-3">
    <?= $page->bladeTemplate()->kt() ?>
  </div>
  <div class="font-mono text-xs color-gray-700">
    <a href="/plugins/afbora/blade"><strong class="font-normal color-black link">Kirby Blade plugin</strong> by Ahmet Bora</a>
  </div>
</div>

<script>
const select    = document.querySelector(".template-select");
const templates = [...document.querySelectorAll(".template-select ~ [data-templating]")];

const changeTemplate = () => {
  templates.forEach(x => x.classList.add("hidden"));
  document.querySelector("#" + select.value).classList.remove("hidden");
}

window.addEventListener("load", () => {
  changeTemplate();
});

select.addEventListener("change", () => {
  changeTemplate();
});
</script>
