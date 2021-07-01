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
      <p class="font-mono text-xs">Total: 897.38 kb</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 46; --color: var(--color-red-400)">vendor.js: <br>464.42 kb</div>
      <div style="--value: 35; --color: var(--color-yellow-400)">app.js: <br>350.48 kb</div>
      <div style="--value: 8; --color: var(--color-blue-300)">app.css: <br>82.48 kb</div>
    </div>
  </div>
  <div style="width: 88%">
    <div class="flex justify-between text-sm mb-1">
      <h4 class="font-bold">3.6-alpha</h4>
      <p class="font-mono text-xs">Total: 791.23 kb</p>
    </div>
    <div class="size text-xs font-mono">
      <div style="--value: 38; --color: var(--color-red-400)">vendor.js: <br>379.32 kb</div>
      <div style="--value: 31; --color: var(--color-yellow-400)">app.js: <br>318.55 kb</div>
      <div style="--value: 9; --color: var(--color-blue-300)">app.css: <br>93.36 kb</div>
    </div>
  </div>
</div>
