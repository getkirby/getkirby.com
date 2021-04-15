<style>
.template-select {
  background: none;
}
</style>


<select class="template-select mb-3">
  <option value="php" selected>PHP template</option>
  <option value="twig">Twig template</option>
</select>

<div id="php" data-template>
  <?= $page->phpTemplate()->kt() ?>
</div>
<div id="twig" data-template class="hidden">
  <?= $page->twigTemplate()->kt() ?>
</div>

<script>
document.querySelector(".template-select").addEventListener("change", e => {
  [...document.querySelectorAll("[data-template]")].forEach(x => x.classList.toggle("hidden"));
})
</script>