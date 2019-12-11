<?php snippet('header', [ 'background' => 'dark' ]) ?>

  <main class="features-page | main" id="maincontent">

    <div class="wrap">

      <?php snippet('hero', ['align' => 'left', 'theme' => 'dark']) ?>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'The Panel',
          'subheading' => 'A headquarter that adapts to your needs'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => $page->image('interface-1.jpg'),
            'class' => 'fading',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Make it yours',
            'rows'  => 3,
            'text' => '
              Kirby lets you create a control panel for yourself and your editors that is tailored to your site. Make the Panel reflect the unique structure of your content, use cases and users—not the other way around.
            '
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('tabs.png'),
            'class' => 'center fading',
          ]) ?>


          <?= snippet('features/text', [
            'heading' => 'User friendly',
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Secure',
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Mobile',
          ]) ?>

          <?= snippet('features/code', [
            'cols'  => 4,
            'rows'  => 2,
            'code'  => $page->bp(),
            'class' => 'fading'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Blueprints',
            'text'    => 'Configure the Panel interface with our unique blueprint system. Add sections, fields, tabs and create intuitive interface layouts right from your editor.',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Quicksearch',
            'text' => '
              Quickly access all pages, users and files with the global search and navigate around with ease.
            '
          ]) ?>
          <?= snippet('features/image', [
            'cols'  => 4,
            'image' => $page->image('search.png'),
            'class' => 'fading stretch',
          ]) ?>



        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'More than just pages',
          'subheading' => 'Articles, albums, events, products – you name it'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => $page->image('interface-2.jpg'),
            'class' => 'fading stretch',
          ]) ?>


          <?= snippet('features/text', [
            'heading' => 'On display, tailor-made',
            'text' => '
              Display pages the way that fits them best: articles, albums, blogs, events, products, docs etc.<br><br>Create individual layouts and add sections so that your pages reflect their nature right in the Panel.
            ',
            'cols' => 3
          ]) ?>


          <?= snippet('features/text', [
            'cols' => 3,
            'heading' => 'Drag & Drop sorting',
            'text' => '
              Sorting pages or files is a breeze: Pick them up and drop them where you want them to be. It shouldn\'t be more complicated than that.
            '
          ]) ?>

          <?= snippet('features/image', [
            'cols' => 4,
            'rows' => 4,
            'image' => $page->image('status.png'),
            'class' => 'center autosize',
          ]) ?>

        <?= snippet('features/text', [
            'heading' => 'Drafts',
            'text' => '
              Prepare your content and only publish it when everything is in place with the click of a button. Send preview links to others so they can review your drafts before they go live.
            ',
            'rows' => 2
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Publishing workfows',
            'rows' => 2,
            'text' => 'Your pages can have three different states: draft, unlisted and listed. Those states can be customized to fit your publishing workflow.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Custom layouts',
            'rows' => 2,
            'text' => 'You want more? Create your own plugins to display pages. Complex tables, gallery grids, maybe even a kanban board? Build your own pages section plugins and get creative.'
          ]) ?>

          <?= snippet('features/image', [
            'heading' => 'Layout',
            'cols' => 4,
            'rows' => 2,
            'text' => '
              Display pages the way that fits them best: articles, albums, blog posts, events, products, docs etc.
            ',
            'class' => 'fading stretch',
            'image' => $page->image('pagetable-2.png'),
          ]) ?>

        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Content management',
          'subheading' => 'Structure your content like never before'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => $page->image('interface-5.jpg'),
            'class' => 'fading stretch',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Custom Fields',
            'text'    => 'Kirby comes with a wide variety of fields that help you build intuitive forms for your content editors and  find the right input type for your data.',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Auto-saving',
            'text'    => 'Don\'t worry about unsaved changes. The Panel stores them for you automatically—even when you go offline—and you can save them later.',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Content-locking',
            'text'    => '
              Collaborate with peace of mind: Kirby\'s advanced content locking features make sure that unsaved changes are never overwritten by your team mates.
            ',
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
            'text' => 'Content editors love the flexibility and intuitive features of our new editor. Write without distraction and add formatting you can trust. The result will be clean, accessible and polished for the web.'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 6,
            'class' => 'fading stretch',
            'image' => $page->image('editor.png')
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Full control',
            'text' => 'As a developer, you decide how each individual block type of the editor is rendered. You control the markup and the design. Nothing happens by accident and all content stays structured.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text' => 'Add new block types to the editor and adjust it to your projects. You need a call to action button, a gallery or a table block? No problem! Our powerful block component API, based on Vue.js, is here for you.'
          ]) ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'Asset managament',
          'subheading' => 'Images, documents, videos, spreadsheets, etc.'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => $page->image('interface-3.jpg'),
            'class' => 'fading',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Your files',
            'text'    => 'Add galleries, covers, hero images, PDF downloads and more right on your page with files sections.',
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Drag & Drop uploads',
            'text'    => null,
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Quality assurance',
            'text'    => null,
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Metadata',
            'text'    => 'Add custom metadata to your files. Define different file types and customize the metadata fields for each type. An image might need a caption and some alternative text. A PDF catalogue download could have an additional pricing list. You can even use those fields for internal notes in your team.',
            'rows'    => 4
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 4,
            'image' => $page->image('metadata.png'),
            'class' => 'fading center stretch',
          ]) ?>

          <?= snippet('features/code', [
            'cols'  => 4,
            'rows'  => 4,
            'code'  => $page->media()->kt(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Media API',
            'text'    => 'Kirby comes with a asychronous media modification API. Resize, crop and convert your images right on the fly in your templates. Start prototyping with different image formats in the browser. Make sure that every visitor gets the perfect file size',
            'rows'    => 4,
          ]) ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'At the core: Files & Folders',
          'subheading' => 'A rock solid, yet simple foundation'
        ]) ?>

        <div class="features-grid">

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->filesystem(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Simple',
            'text'    => 'Don\'t give up control over your data. Kirby stores your data in files and folders. Universally accessible in each operating system and editable with any text editor.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Fast',
            'text'    => 'The file system is much faster than you might think. Most often even way faster than a database. Add SSD drives to your server and you have a system that can fly.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Resilient',
            'text'    => 'Files and folders are probably the most future-proof way to store your data. Add version control via Git, simple backup options and syncing via tools like rsync.'
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
            'text'    => '
              Kirby comes with a powerful PHP-based template engine. Optimized for speed and equipped with an ultra flexible and intuitive PHP API, you can build your perfect frontend the way you like.
            '
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->templates(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Controllers',
            'text'    => 'Too much logic for your templates? Use Kirby\'s template controllers to handle complex data collections, form handling, URL query-based filters and more without cluttering your templates. Marie Kondo agrees.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Models',
            'text' => 'Super-charge your pages with additional functionalities. Page models extend our default page class and offer unlimited opportunities to customize what a page represents.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Collections',
            'text' => 'Keep your code DRY with collections. Featured articles, upcoming events, team members – create reusable collections and use them in your templates or plugins.'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->twig(),
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 4,
            'heading' => 'Bring your own engine',
            'text'    => 'Your team is familiar with Twig, Blade or your own template engine? No problem! Our engine can be swapped out with an existing plugin or you can even create your own.'
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
            'heading' => 'REST-ful by nature',
            'text' => 'Use Kirby like a classic CMS or convert it into a powerful, headless content container. Connect it to mobile applications, static site generators or your custom frontend.'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->api(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text'    => 'Define your own API endpoints and object. Integrate external data from databases, files or other APIs with data from Kirby into one seamless data-source.'
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
            'class' => 'fading',
            'heading' => 'Language management',
            'text'    => 'Create new languages right in the Panel and start translating your pages immediately. Start with a single language and move to multiple languages later, or go global immeditately—it\'s up to your project.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Create & Translate',
            'image' => $page->image('translations.png'),
            'cols' => 3,
            'rows' => 3,
            'class' => 'fading',
            'text' => 'Internationalization is built into the core of Kirby. Switch intuitively between different language versions and translate your content together with your team or on your own.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Translatable URLs',
            'text'    => 'You can customize the main URL for each language, including subdomains. Combine this with translatable paths for pages to make your visitors feel at home.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Language detection',
            'text'    => 'Switch to automatic language detection and let Kirby figure out which language works best for your current visitor.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Integrate',
            'text'    => 'Are you using a translation service like Memsource? Use the amazing Memsource plugin to import and export translations for your translators right from the Panel.'
          ]) ?>
        </div>
      </section>

      <section class="features-section">
        <?= snippet('features/header', [
          'heading' => 'User management',
          'subheading' => 'You are not alone in this'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'From the backend...',
            'text'    => 'The Panel offers you an easy way to manage your users and set up rights based on different roles. Create different user types and store metadata to your users.'
          ]) ?>

          <?= snippet('features/image', [
            'image'   => $page->image('languages.png'),
            'cols'    => 4,
            'rows'    => 2,
            'class' => 'fading'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 2,
            'code' => $page->users(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => '...to the front stage',
            'text'    => 'Integrate user permissions in your site to create protected sections on your site. Or launch whole communities based on Kirby\'s user system.'
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
            'image' => $page->image('matomo.jpg'),
            'class' => 'fading'
          ]) ?>
          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom sections',
            'text'    => 'Add entirely new interface elements to the panel with custom sections. Integrate data from analytics tools, your ERM system, third-pary services and more and use them seamlessly alongside your  content.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Routes',
            'text'    => 'Routing has never been easier: Kirby comes with a powerful router that can be extended to adjust the URL scheme, handle form submissions, add webhook endpoints, or create virtual pages.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Hooks',
            'text'    => 'React to specific events with hooks and trigger your own actions. Resize a file on upload, add data to a newly created page, add custom content validations and more.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Field methods',
            'text'    => 'Register additional methods to work with content fields. Transform content directly in your templates and clean up your template code along the way.'
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom fields',
            'text'    => 'Extend your forms with your own fields or use plugins from other developers. Editing data on steroids: locations, colors, annotations etc. '
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('locator.png'),
            'class' => 'fading'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Core components',
            'text'    => 'You don\'t like our template engine, markdown parser or media API? Simply swap out major parts of the Kirby system with your own plugins.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'KirbyTags',
            'text'    => 'When Markdown isn\'t enough, add your own KirbyTags to simplify plain text formatting and to inject complex custom components into long-form text.'
          ]) ?>
          <?= snippet('features/text', [
            'heading' => 'Caching',
            'text'    => 'Kirby comes with mighty caching on board. Not fitting for your project? Add your cache driver of choice and reduce page loads in the blink of an eye.'
          ]) ?>

          <?= snippet('features/image', [
            'cols'   => 4,
            'rows'   => 3,
            'class' => 'center',
            'image'  => $page->image('retour.png')
          ]) ?>
          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom views',
            'text'    => 'Add whole new views and menu items to super-charge the Panel as an admin framework for your own integrated applications.'
          ]) ?>

        </div>
      </section>

      <div class="intro | -theme:dark">
         <?= kt('And so much more...
Learn about everything in our (link: docs text: Guide)') ?>
      </div>

    </div>

  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
