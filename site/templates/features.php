<?php snippet('header', [ 'background' => 'dark' ]) ?>

  <main class="features-page | main" id="maincontent">

    <div class="wrap">

      <?php snippet('hero', ['align' => 'left', 'theme' => 'dark']) ?>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'The panel',
          'subheading' => 'A control room that feels like home'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => $page->image('interface.jpg'),
            'fade'  => true
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Drafts',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Drag & Drop sorting',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'rows' => 6,
            'heading' => 'Fields',
            'text' => '
              Kirby comes with a wide variety of fields that helps you to build intuitive forms for your content editors.
              <ul>
                <li>Checkboxes</li>
                <li>Date</li>
                <li>Email</li>
                <li>Files</li>
                <li>Headline</li>
                <li>Hidden</li>
                <li>Info</li>
                <li>Line</li>
                <li>Multiselect</li>
                <li>Number</li>
                <li>Pages</li>
                <li>Radio</li>
                <li>Range</li>
                <li>Select</li>
                <li>Structure</li>
                <li>Tags</li>
                <li>Tel</li>
                <li>Text</li>
                <li>Textarea</li>
                <li>Time</li>
                <li>Toggle</li>
                <li>Url</li>
                <li>Users</li>
              </ul>
            '
          ]) ?>

          <?= snippet('features/image', [
            'cols'    => 4,
            'rows'    => 6,
            'fade'    => true,
            'image'   => $page->image('fields-2.png')
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Pages',
            'cols'    => 3,
            'rows'    => 3,
            'fade'    => true,
            'image'   => $page->image('pages.png'),
            'text'    => 'Display pages in the way that fits best. Articles, albums, docs, main pages, etc.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Files',
            'cols'    => 3,
            'rows'    => 3,
            'fade'    => true,
            'image'   => $page->image('gallery.png'),
            'text'    => 'Add galleries, covers, hero images, PDF downloads and more with the files section'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Search',
            'text'    => 'Quickly access all pages, users and files with the global panel search and navigate around easily',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Unsaved changes',
            'text'    => 'Don\'t worry about unsaved changes. The Panel stores them for you automatically – even when you go offline – and you can save them later. The "Unsaved changes" dialog helps you to keep track',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Teamwork',
            'text'    => 'Kirby\'s advanced content locking features make sure that unsaved changes are never overwritten by your team mate.',
          ]) ?>

        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Next level editing',
          'subheading' => 'Write with style, stay in style'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'Writing',
            'text' => 'Content editors love the flexibility and intuitive features of our new editor. Write without distraction and add formatting that you can trust. Always be sure that the result will be clean, accessible and polished for the web.'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 6,
            'center' => true,
            'image' => $page->image('editor.png')
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Full control',
            'text' => 'As a developer, you have full control how each individual block type of the editor is rendered. You control the markup and the design. Nothing happens by accident and all content stays structured.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text' => 'Add new block types to the editor and adjust it to your projects. You need a call to action button, a gallery or a table block? No problem! Our powerful block component API, based on Vue.js, is here for you.'
          ]) ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Files & Folders',
          'subheading' => 'A rock solid and yet simple foundation'
        ]) ?>

        <div class="features-grid">

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->filesystem(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Simple',
            'text'    => 'Kirby stores your data in files and folders. Universally accessible in each operating system and editable with any text editor.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Fast',
            'text'    => 'The file system is much faster than you might think. Most often even way faster than a database. Add SSD drives to your server and you have a system that can fly.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Resilient',
            'text'    => 'Files and folders are probably the most future-proof way to store your data. Add version controlling via Git, simple backup options and syncing via tools like rsync.'
          ]) ?>

        </div>
      </section>


      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Templating',
          'subheading' => 'Stay in control of your markup. Keep your projects lean.'
        ]) ?>

        <div class="features-grid">

          <?= snippet('features/text', [
            'rows'    => 4,
            'heading' => 'Templates',
            'text'    => 'Kirby comes with a powerful, PHP-based template engine. Optimized for speed and equipped with a ultra flexible PHP Api, you can build your perfect frontend in the way you like.'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->templates(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Controllers',
            'text'    => 'Too much logic for your templates? Use Kirby\'s template controllers to handle complex data collections, form handling, URL query-based filters and more.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Models',
            'text' => 'Super-charge your pages with additional functionalities. Page models extend our default page class and offer unlimited opportunities'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Collections',
            'text' => 'Keep your code DRY with collections. Articles, albums, team members – create reusable collections and use them in your templates or plugins'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->twig(),
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 4,
            'heading' => 'Bring your own engine',
            'text'    => 'Your team is familiar with Twig, Blade or your own template engine? No problem! Our engine can be replaced with an existing plugin or you can write your own.'
          ]) ?>

        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Go headless',
          'subheading' => 'Modern publishing possibilities at your fingertips'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'REST-ful',
            'text' => 'Use Kirby like any other classic CMS or convert it into a powerful, headless content container. Connect it to mobile applications, static site generators or your custom frontend'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->api(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text'    => 'Define your own API endpoints and merge data from Kirby and other APIs into one consistent data-source'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Secure',
            'text'    => 'Use our built-in authentication methods to connect securely from the same server or a remote application.'
          ]) ?>

        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Go global',
          'subheading' => 'Built-in internationalization'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'image'   => $page->image('languages.png'),
            'cols'    => 3,
            'rows'    => 3,
            'fade'    => true,
            'heading' => 'Language management',
            'text'    => 'Create new languages right in the Panel and start translating your pages immediately. Start with a single language and move to multiple languages later, or go global immeditately – it\'s up to your project'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Create & Translate',
            'image' => $page->image('translations.png'),
            'cols' => 3,
            'rows' => 3,
            'fade' => true,
            'text' => 'Internationalization is built into the core of Kirby. Switch intuitively between different language versions and translate your content together with your team or on your own.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Translatable URLs',
            'text'    => 'You can customize the main URL for each language, including subdomains. Combine this with translatable paths for pages to make your visitors feel at home.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Language detection',
            'text'    => 'Switch no automatic language detection and let Kirby figure out, which language works best for your current visitor.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Integrate',
            'text'    => 'You are using a translation service like Memsource? Use the amazing Memsource plugin to import and export translations for your translators.'
          ]) ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Plugins',
          'subheading' => 'Endless options for projects without roadblocks'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols' => 4,
            'rows' => 3,
            'image' => $page->image('matomo.jpg')
          ]) ?>
          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom sections',
            'text'    => 'Add entirely new interface elements to the panel with custom section plugins. Integrate data from analytics tools, your ERM system, third-pary services and more and integrate them seamlessly.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Field methods',
            'text'    => 'Register additional methods to work with content fields. Transform content directly in your templates and clean up your template code along the way.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Hooks',
            'text'    => 'React to panel events with hooks. Resize a file on upload, add data to a newly created page, add custom content validations and more'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Routes',
            'text'    => 'Kirby comes with a powerful router that can be extended to adjust the URL scheme, handle form submissions, add webhook endpoints, or create virtual pages.'
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom fields',
            'text'    => 'Extend your forms with your own fields and plugins from other developers.'
          ]) ?>
          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('locator.png')
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Core components',
            'text'    => 'You don\'t like our template engine, markdown parser or media API? Replace major parts of the Kirby system with your own plugins'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'KirbyTags',
            'text'    => 'Add your own KirbyTag plugins to simplify plain text formatting and injection of complex custom components into long-form text'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Collection methods',
            'text'    => 'Extend Kirby\'s collections of files, users and pages with your own methods and filters'
          ]) ?>

          <?= snippet('features/image', [
            'cols'   => 4,
            'rows'   => 3,
            'center' => true,
            'image'  => $page->image('retour.png')
          ]) ?>
          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom views',
            'text'    => 'Add new menu items to the panel menu and use the panel as a admin framework for your own integrated applications.'
          ]) ?>

        </div>
      </section>


    </div>

  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
