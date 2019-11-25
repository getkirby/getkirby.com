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
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'rows' => 4,
            'heading' => 'Fields',
            'text' => 'Kirby comes with a wide variety of fields that helps you to build intuitive forms for your content editors.'
          ]) ?>

          <?= snippet('features/image', [
            'cols'    => 4,
            'rows'    => 4,
            'center'  => true,
            'image'   => $page->image('fields.png')
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
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Feature',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Feature',
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
            'heading' => 'Editing'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 6,
            'center' => true,
            'image' => $page->image('editor.png')
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Full control'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible'
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
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Fast'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Resilient'
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
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Collections',
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->twig(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Bring your own engine',
            'rows'    => 4,
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
            'cols' => 2,
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->api(),
          ]) ?>

          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Go global',
          'subheading' => 'Built-in internationalization'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'image' => $page->image('languages.png'),
            'cols' => 3,
            'rows' => 3,
            'fade' => true,
            'heading' => 'Language management'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Create & Translate',
            'image' => $page->image('translations.png'),
            'cols' => 3,
            'rows' => 3,
            'fade' => true
          ]) ?>

          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
          <?= snippet('features/text') ?>
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
            'text' => 'React to panel events with hooks. Resize a file on upload, add data to a newly created page, add custom content validations and more'
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
            'cols' => 4,
            'rows' => 3,
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
            'cols' => 4,
            'rows' => 3,
            'center' => true,
            'image' => $page->image('retour.png')
          ]) ?>
          <?= snippet('features/text', [
            'rows' => 3,
            'heading' => 'Custom views',
            'text' => 'Add new menu items to the panel menu and use the panel as a admin framework for your own integrated applications.'
          ]) ?>

        </div>
      </section>


    </div>

  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
