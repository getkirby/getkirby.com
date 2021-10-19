<style>
.size {
  display: flex;
}
.size > * {
  background: var(--color);
  padding: .5rem;
  flex-grow: var(--value)
}
</style>

<div class="pt-12">
  <div class="mb-6">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold">3.5.7</h4>
      <p class="font-mono text-xs">Total: 808.36 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 46; --color: var(--color-red-400)">vendor.js: <br>457.04 KB</div>
      <div style="--value: 35; --color: var(--color-yellow-400)">app.js: <br>351.32 KB</div>
    </div>
  </div>
  <div class="mb-12" style="width: 83%">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold"><?= $page->title() ?></h4>
      <p class="font-mono text-xs">Total: 694.98 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 38; --color: var(--color-red-400)">vendor.js: <br>385.04 KB KB</div>
      <div style="--value: 30; --color: var(--color-yellow-400)">app.js: <br>309.94 KB KB</div>
    </div>
  </div>

  <div>
    <div class="text-2xl">-113.38 KB</div>
    <div class="font-mono text-xs"> less JS</div>
  </div>
</div>
