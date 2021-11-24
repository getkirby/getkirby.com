<?php layout() ?>

<style>
  .input {
    border: 1px solid var(--color-gray-300);
    background: var(--color-white);
    padding: var(--spacing-2) var(--spacing-3);
  }

  .input.select {
    position: relative;
  }

  .input.select::after {
    content: "&nbsp;";
  }

  .input>select {
    inset: 0;
    position: absolute;
    appearance: none;
    padding: var(--spacing-2) var(--spacing-3);
    width: 100%;
    cursor: pointer;
  }

  .label {
    display: block;
    font-weight: var(--font-bold);
    margin-bottom: var(--spacing-3);
  }

  .codeblock {
    background: var(--color-black);
    border-radius: var(--rounded);
    font-family: var(--font-mono);
    font-size: var(--text-base);
    color: var(--color-white);
    overflow-x: auto;
    padding: var(--spacing-6);
  }
</style>

<script type="module">
  import {
    createApp
  } from 'https://unpkg.com/petite-vue?module'

  createApp({
    author: {
      id: 'your-id',
      name: '',
      email: ''
    },
    description: '',
    license: 'MIT',
    name: 'plugin-name',
    panel: false,
    get composer() {
      return JSON.stringify({
        name: this.pluginId,
        description: this.description,
        type: 'kirby-plugin',
        license: this.license,
        homepage: this.homepage,
        authors: [{
          name: this.author.name,
          email: this.author.email
        }, ],
        require: {
          'getkirby/composer-installer': '^1.2'
        },
        extra: {
          "installer-name": this.pluginName
        },
      }, null, 2);
    },
    get homepage() {
      return 'https://getkirby.com/plugins/' + this.pluginId;
    },
    get indexJS() {

      return `panel.plugin('${this.pluginId}', {
  components: {

  }
});`;

    },
    get indexPHP() {

      return `<` + `?php

Kirby::plugin('${this.pluginId}', [

]);`;

    },
    get package() {
      return JSON.stringify({
        scripts: {
          dev: "npx -y kirbyup src/index.js --watch",
          build: "npx -y kirbyup src/index.js"
        }
      }, null, 2);
    },
    get pluginId() {
      return this.sluggify(this.author.id) + '/' + this.pluginName;
    },
    get pluginName() {
      return this.sluggify(this.name);
    },
    sluggify(string) {
      return string.toLowerCase().replace(/[^a-z0-9]/g, "-");
    }
  }).mount();
</script>

<article v-scope class="mb-42">
  <h1 class="h1 mb-12"><?= $page->title() ?></h1>

  <div class="columns highlight rounded bg-light" style="--columns: 2; --gap: var(--spacing-24)">

    <form method="post">
      <div class="columns" style="--gap: var(--spacing-6)">
        <div style="--span: 6">
          <label class="label">Developer ID</label>
          <input class="input" required name="author.id" autofocus type="text" v-model="author.id">
        </div>
        <div style="--span: 6">
          <label class="label">Plugin name</label>
          <input class="input" required name="plugin.name"  type="text" v-model="name">
        </div>
        <div style="--span: 12">
          <label class="label">Description</label>
          <input class="input" required name="description" type="text" v-model="description">
        </div>
        <div style="--span: 12">
          <label class="label">License</label>
          <div class="input select">
            <select name="license" v-model="license">
              <option value="MIT">MIT</option>
              <option value="The Unlicense">The Unlicense</option>
              <option value="Commercial">Commercial</option>
            </select>
          </div>
        </div>
        <div style="--span: 6">
          <label class="label">Author name</label>
          <input class="input" required name="author.name" type="text" v-model="author.name">
        </div>
        <div style="--span: 6">
          <label class="label">Author email</label>
          <input class="input" required name="author.email" type="email" v-model="author.email">
        </div>
        <div class="mb-12" style="--span: 12">
          <h2 class="label">Features</h2>
          <label><input type="checkbox" class="mr-3" v-model="panel"> Panel extensions</label>
        </div>
        <div style="--span: 12">
          <button class="btn btn--filled">
            <?= icon('download') ?>
            Download
          </button>
        </div>
      </div>
    </form>

    <div>
      <div class="mb-6">
        <label class="label">composer.json</label>
        <pre class="codeblock"><code>{{ composer }}</code></pre>
      </div>
      <div class="mb-6">
        <label class="label">index.php</label>
        <pre class="codeblock"><code>{{ indexPHP }}</code></pre>
      </div>
      <template v-if="panel">
        <div class="mb-6">
          <label class="label">package.json</label>
          <pre class="codeblock"><code>{{ package }}</code></pre>
        </div>
        <div>
          <label class="label">index.js</label>
          <pre class="codeblock"><code>{{ indexJS }}</code></pre>
        </div>
      </template>
    </div>
  </div>

</article>
