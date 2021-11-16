<style>
  .size {
    display: flex;
  }

  .size>* {
    background: var(--color);
    padding: .5rem;
    flex-grow: var(--value)
  }
</style>

<div class="pt-12">
  <div class="mb-6">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold">3.5.8</h4>
      <p class="font-mono text-xs">Total: 808.50 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 46; --color: var(--color-red-400)">vendor.js: <br>457.04 KB</div>
      <div style="--value: 35; --color: var(--color-yellow-400)">app.js: <br>351.46 KB</div>
    </div>
  </div>
  <div class="mb-12" style="width: 86.24%">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold"><?= $page->title() ?></h4>
      <p class="font-mono text-xs">Total: 697.15 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 39; --color: var(--color-red-400)">vendor.js: <br>385.04 KB</div>
      <div style="--value: 31; --color: var(--color-yellow-400)">index.js: <br>312.11 KB</div>
    </div>
  </div>

  <div>
    <div class="text-2xl">-111.35 KB</div>
    <div class="font-mono text-xs"> less uncompressed JS</div>
  </div>
</div>
