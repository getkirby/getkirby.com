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
      <p class="font-mono text-xs">Total: 891.06 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 46; --color: var(--color-red-400)">vendor.js: <br>457.04 KB</div>
      <div style="--value: 35; --color: var(--color-yellow-400)">app.js: <br>351.32 KB</div>
      <div style="--value: 8; --color: var(--color-blue-300)">app.css: <br>82.70 KB</div>
    </div>
  </div>
  <div class="mb-12" style="width: 88%">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold">3.6-alpha</h4>
      <p class="font-mono text-xs">Total: 793.01 KB</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 38; --color: var(--color-red-400)">vendor.js: <br>379.33 KB</div>
      <div style="--value: 32; --color: var(--color-yellow-400)">index.js: <br>318.27 KB</div>
      <div style="--value: 10; --color: var(--color-blue-300)">app.css: <br>95.41 KB</div>
    </div>
  </div>

  <div>
    <div class="text-2xl">-111 KB</div>
    <div class="font-mono text-xs"> less JS</div>
  </div>
</div>
