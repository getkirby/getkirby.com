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
    padding: var(--spacing-3);
  }

  .strikethrough {
    text-decoration: line-through;
  }

  .plugin-file {
    background: var(--color-white);
  }

  .plugin-file[open] {
    background: var(--color-black);
    color: var(--color-white);
  }

  .plugin-file summary {
    font-weight: var(--font-bold);
    padding: var(--spacing-2) var(--spacing-3);
  }

  .plugin-file input {
    margin: 0 var(--spacing-2);
  }

  .plugin-file[open] summary {
    border-bottom: 1px solid var(--color-gray-800);
  }
</style>

<?= js('assets/js/libraries/jszip.js') ?>
<?= js('assets/js/libraries/filesaver.js') ?>
<script type="module">
  import {
    createApp,
    reactive
  } from '<?= url('assets/js/libraries/petite-vue.js') ?>';

  const templates = <?= $templates ?>;

  const esc = (string) => {
    const entityMap = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;',
      '/': '&#x2F;',
      '`': '&#x60;',
      '=': '&#x3D;'
    };

    return String(string).replace(/[&<>"'`=/]/g, (char) => {
      return entityMap[char];
    });
  };

  const json = (data) => {
    return JSON.stringify(data, null, 2);
  };

  const sluggify = (string) => {
    return string.toLowerCase().replace(/[^a-z0-9]/g, "-");
  };

  const template = (string, values = {}) => {
    const resolve = (parts, data = {}) => {
      const part = esc(parts.shift());
      const value = data[part] ?? null;

      if (value === null) {
        return Object.prototype.hasOwnProperty.call(data, part) || "…";
      } else if (parts.length === 0) {
        return value;
      } else {
        return resolve(parts, value);
      }
    };

    const opening = "[{]{1,2}[\\s]?";
    const closing = "[\\s]?[}]{1,2}";

    string = string.replace(new RegExp(`${opening}(.*?)${closing}`, "gi"), ($0, $1) => {
      return resolve($1.split("."), values);
    });

    return string.replace(new RegExp(`${opening}.*${closing}`, "gi"), "…");
  };

  const author = reactive({
    id: 'your-id',
    name: '',
    email: '',
    get homepage() {
      return 'https://getkirby.com/plugins/' + this.slug
    },
    get slug() {
      return sluggify(this.id);
    },
  });

  const plugin = reactive({
    description: '',
    license: 'MIT',
    name: 'plugin-name',
    get homepage() {
      return 'https://getkirby.com/plugins/' + this.id;
    },
    get id() {
      return author.slug + '/' + this.slug;
    },
    get slug() {
      return sluggify(this.name);
    },
  });

  const files = reactive({
    gitattributes: {
      filename: '.gitattributes',
      include: true,
      get contents() {
        return template(templates.gitattributes);
      },
    },
    gitignore: {
      filename: '.gitignore',
      include: true,
      get contents() {
        return template(templates.gitignore);
      },
    },
    editorconfig: {
      filename: '.editorconfig',
      include: true,
      get contents() {
        return template(templates.editorconfig);
      },
    },
    composer: {
      filename: 'composer.json',
      include: true,
      open: true,
      get contents() {
        return json({
          name: plugin.id,
          description: plugin.description,
          type: 'kirby-plugin',
          license: plugin.license,
          homepage: plugin.homepage,
          version: "0.1.0",
          authors: [{
            name: author.name,
            email: author.email,
            homepage: author.homepage
          }, ],
          require: {
            'getkirby/composer-installer': '^1.2'
          },
          extra: {
            "installer-name": plugin.name
          },
        });
      },
    },
    indexphp: {
      filename: 'index.php',
      include: true,
      get contents() {
        return template(templates.indexphp, {
          author,
          plugin
        });
      },
    },
    license: {
      filename: 'LICENSE.md',
      include: true,
      get contents() {
        return template(templates.license, {
          author,
          plugin,
          year: new Date().getFullYear()
        });
      },
    },
    indexjs: {
      filename: 'src/index.js',
      include: true,
      get contents() {
        return template(templates.indexjs, {
          author,
          plugin
        });
      },
    },
    package: {
      filename: 'package.json',
      include: true,
      get contents() {
        return json({
          scripts: {
            dev: "npx -y kirbyup src/index.js --watch",
            build: "npx -y kirbyup src/index.js"
          }
        });
      },
    },
    readme: {
      filename: 'README.md',
      include: true,
      get contents() {
        return template(templates.readme, {
          author,
          plugin
        });
      }
    },
    security: {
      filename: 'SECURITY.md',
      include: true,
      get contents() {
        return template(templates.security, {
          author,
          plugin
        });
      },
    }
  });

  createApp({
    author,
    files,
    plugin,
    onInputAuthorId(event) {
      author.id = sluggify(event.target.value);
    },
    onInputPluginName(event) {
      plugin.name = sluggify(event.target.value);
    },
    async zip() {
      var zip = new JSZip();

      Object.keys(this.files).forEach(key => {
        const file = this.files[key];

        if (file.include) {
          zip.file(plugin.slug + "/" + file.filename, file.contents);
        }
      });

      zip.generateAsync({
          type: "blob"
        })
        .then(content => {
          saveAs(content, plugin.slug + ".zip");
        });

    }
  }).mount();
</script>

<article v-scope class="mb-42">
  <h1 class="h1 mb-12"><?= $page->title() ?></h1>

  <div class="columns highlight rounded bg-light" style="--columns: 2; --gap: var(--spacing-24)">

    <div>
      <div class="columns" style="--gap: var(--spacing-6)">
        <div style="--span: 6">
          <label class="label">Developer ID</label>
          <input class="input" autofocus type="text" :value="author.id" @input="onInputAuthorId">
        </div>
        <div style="--span: 6">
          <label class="label">Plugin name</label>
          <input class="input" type="text" :value="plugin.name" @input="onInputPluginName">
        </div>
        <div style="--span: 12">
          <label class="label">Description</label>
          <input class="input" type="text" v-model="plugin.description">
        </div>
        <div style="--span: 6">
          <label class="label">Author name</label>
          <input class="input" type="text" v-model="author.name">
        </div>
        <div style="--span: 6" class="mb-12">
          <label class="label">Author email</label>
          <input class="input" type="email" v-model="author.email">
        </div>
        <div style="--span: 12">
          <button type="button" @click="zip" class="btn btn--filled">
            <?= icon('download') ?>
            Download
          </button>
        </div>
      </div>
    </div>

    <div>
      <h2 class="label">Files</h2>
      <details class="plugin-file rounded shadow mb-1" v-for="(file, key) in files" :key="key" :open="file.open" class="mb-3">
        <summary class="summary font-mono text-sm" :class="{strikethrough: !file.include}">
          <span class="inline-flex items-center">
            <input type="checkbox" v-model="file.include">
            {{ file.filename }}
          </span>
        </summary>
        <pre class="codeblock"><code>{{ file.contents }}</code></pre>
      </details>
    </div>
  </div>

</article>
