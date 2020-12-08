<?php snippet('header', [ 'background' => 'dark' ]) ?>

  <main class="features-page | main" id="maincontent">

    <div class="wrap">
      <?php snippet('hero', ['align' => 'left', 'theme' => 'dark']) ?>
    </div>

    <section class="features-section">

      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'The Panel',
          'id'         => 'panel',
          'subheading' => 'A headquarter that adapts to your needs'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'class' => 'center',
            'image' => page('home')->image('dashboard.png')->resize(1200),
            'alt'   => 'A screenshot of Kirby\'s admin interface'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Make it yours',
            'rows'  => 3,
            'text' => 'Kirby lets you create a control panel for yourself and your editors that is tailored to your site. Make the Panel reflect the unique structure of your content, use&nbsp;cases and users—not the other way around.',
            'link' => 'docs/guide/blueprints/introduction'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('blueprints.png'),
            'class' => 'center',
            'link'  => 'docs/guide/blueprints/introduction',
            'alt'   => 'An illustration of Kirby\'s flexible blueprint system'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'User-friendly',
            'text' => 'The Panel is optimized to make editors more happy and productive. There\'s no need for long training sessions and on-boarding new editors is a breeze.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Secure',
            'text' => 'Extensive permissions, brute-force login protection and state of the art session management keeps your panel protected. Customize the panel URL or even switch it off on your production server for even less attack vectors.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Mobile-ready',
            'text' => 'You want to edit your site on the go? The Panel works nicely on mobile browsers in iOS and Android.'
          ]) ?>

          <?= snippet('features/code', [
            'cols'  => 4,
            'rows'  => 2,
            'code'  => $page->bp(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Blueprints',
            'text'    => 'Configure the Panel interface with our unique blueprint system. Add sections, fields, tabs and create intuitive interface layouts right from your editor.',
            'link'    => 'docs/guide/blueprints/introduction'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Quicksearch',
            'text'    => 'Quickly access all pages, users and files with the global search and navigate around with ease.',
            'alt'     => 'A screenshot of the quicksearch in the Panel'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'image' => $page->image('search.jpg'),
            'class' => 'stretch',
          ]) ?>

        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">

        <?= snippet('features/header', [
          'heading'    => 'More than just pages',
          'id'         => 'pages',
          'subheading' => 'Articles, albums, events, products – you name it'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => page('home')->image('microsite.png')->resize(1200),
            'class' => 'center',
            'alt'   => 'A screenshot of a Panel setup for blog articles'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'On display, tailor-made',
            'text'    => 'Display pages the way that fits them best: articles, albums, blogs, events, products, docs etc.<br><br>Create individual layouts and add sections so that your pages reflect their nature right in the Panel.',
            'cols'    => 3
          ]) ?>

          <?= snippet('features/text', [
            'cols' => 3,
            'heading' => 'Drag & Drop sorting',
            'text' => 'Sorting pages or files is a breeze: Pick them up and drop them where you want them to be. It shouldn\'t be more complicated than that.'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 4,
            'image' => $page->image('status.png'),
            'class' => 'center autosize',
            'alt'   => 'A screenshot of Kirby\'s modal window to switch a page status from draft to public'
          ]) ?>

        <?= snippet('features/text', [
            'heading' => 'Drafts',
            'text'    => 'Prepare your content and only publish it when everything is in place with the click of a button. Send preview links to others so they can review your drafts before they go live.',
            'rows'    => 2
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Publishing workflows',
            'rows'    => 2,
            'text'    => 'Your pages can have three different states: draft, unlisted and listed. Those states can be customized to fit your publishing workflow.',
            'link'    => 'docs/guide/content/publishing-workflow',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Custom layouts',
            'rows'    => 2,
            'text'    => 'You want more? Create your own plugins to display pages. Complex tables, gallery grids, maybe even a kanban board? Build your own pages section plugins and get creative.',
            'link'    => 'docs/reference/plugins/extensions/sections'
          ]) ?>

          <?= snippet('features/image', [
            'cols'    => 4,
            'rows'    => 2,
            'class'   => 'stretch',
            'image'   => $page->image('pagetable.jpg'),
            'link'    => 'https://github.com/sylvainjule/kirby-pagetable',
            'alt'     => 'A screenshot of the PageTable plugin by Sylvain Julé',
          ]) ?>

        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Content management',
          'id'         => 'content',
          'subheading' => 'Structure your content like never before'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => page('home')->image('article.png')->resize(1200),
            'class' => 'stretch',
            'alt'   => 'An example of a more complex panel layout with multiple custom fields'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Custom Fields',
            'text'    => 'Kirby comes with a wide variety of fields that help you build intuitive forms for your content editors and  find the right input type for your data.',
            'link'    => 'docs/reference/panel/fields'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Auto-saving',
            'text'    => 'Don\'t worry about unsaved changes. The Panel stores them for you automatically—even when you go offline—and you can save them later.',
            'link'    => 'docs/guide/content/publishing-workflow#unsaved-changes',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Content-locking',
            'text'    => 'Collaborate with peace of mind: Kirby\'s advanced content locking features make sure that unsaved changes are never overwritten by your team mates.',
            'link'    => 'docs/guide/content/publishing-workflow#content-locking',
          ]) ?>

        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Next level editing',
          'id'         => 'editor',
          'subheading' => 'Write with style, stay in style'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'Writing',
            'text'    => 'Content editors love the flexibility and intuitive features of our blocks field. Write without distraction and add formatting you can trust. The result will be clean, accessible and polished for the web.',
            'link'    => 'docs/reference/panel/fields/blocks',
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 6,
            'class' => 'stretch',
            'image' => $page->image('blocks.jpg'),
            'link'  => 'docs/reference/panel/fields/blocks',
            'alt'   => 'A screenshot of Kirby\'s visual block editor'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Full control',
            'text'    => 'As a developer, you decide how each individual block type is rendered. You control the markup and the design. Nothing happens by accident and all content stays structured.',
            'link'    => 'docs/reference/panel/fields/blocks'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text'    => 'Add new block types: You need a call to action button, product previews or a table block? No problem! Our powerful block component API, based on Vue.js, is here for you.',
            'link'    => 'docs/reference/panel/fields/blocks'
          ]) ?>
        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Asset managament',
          'id'         => 'assets',
          'subheading' => 'Images, documents, videos, spreadsheets, etc.'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 6,
            'rows'  => 4,
            'image' => page('home')->image('interface-4.jpg')->resize(1200),
            'alt'   => 'An example of a photo gallery setup in the Panel'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Your files',
            'text'    => 'Add galleries, covers, hero images, PDF downloads and more right on your page with files sections.',
            'link'    => 'docs/guide/content/files'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Drag & Drop uploads',
            'text'    => 'Editors can upload multiple new files at once with the intuitive drag & drop uploader.',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Quality assurance',
            'text'    => 'Add fine-grained upload validators and check for image dimensions, file types, file size and more to avoid unwanted uploads.',
            'link'    => 'docs/reference/panel/blueprints/file#accept',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Metadata',
            'text'    => 'Add custom metadata to your files. Define different file types and customize the metadata fields for each type. An image might need a caption and some alternative text. A PDF catalogue download could have an additional pricing list. You can even use those fields for internal notes in your team.',
            'rows'    => 4,
            'link'    => 'docs/reference/panel/blueprints/file',
            'alt'     => 'The file metadata editor in the Panel'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 4,
            'image' => $page->image('metadata.jpg'),
            'class' => 'center stretch',
            'link'  => 'docs/reference/panel/blueprints/file',
          ]) ?>

          <?= snippet('features/code', [
            'cols'  => 4,
            'rows'  => 4,
            'code'  => $page->media()->kt(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Media API',
            'text'    => 'Kirby comes with an asynchronous media modification API. Resize, crop and convert your images right on the fly in your templates. Start prototyping with different image formats in the browser. Make sure that every visitor gets the perfect image size.',
            'rows'    => 4,
            'link'    => 'docs/guide/templates/resize-images-on-the-fly',
          ]) ?>
        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'At the core: Files & Folders',
          'id'         => 'no-database',
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
            'text'    => 'Stay in control over your data. Kirby stores your data in files and folders. Universally accessible in each operating system and editable with any text editor.',
            'link'    => 'docs/guide/content/introduction'
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
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Templating',
          'id'         => 'templating',
          'subheading' => 'Stay in control of your markup. Keep your projects lean.'
        ]) ?>

        <div class="features-grid">

          <?= snippet('features/text', [
            'rows'    => 4,
            'heading' => 'Templates',
            'text'    => 'Kirby comes with a powerful PHP-based template engine. Optimized for speed and equipped with an ultra flexible and intuitive PHP API, you can build your perfect frontend the way you like.',
            'link'    => 'docs/guide/templates/basics'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->templates(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Controllers',
            'text'    => 'Too much logic for your templates? Use Kirby\'s controllers to handle complex data collections, form handling, URL query-based filters and more without cluttering your templates. Marie Kondō agrees.',
            'link'    => 'docs/guide/templates/controllers'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Models',
            'text'    => 'Super-charge your pages with additional functionalities. Page models extend our default page class and offer unlimited opportunities to customize what a page represents.',
            'link'    => 'docs/guide/templates/page-models'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Collections',
            'text'    => 'Keep your code DRY with collections. Featured articles, upcoming events, team members – create reusable collections and use them in your templates or plugins.',
            'link'    => 'docs/guide/templates/collections'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 4,
            'code' => $page->twig(),
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 4,
            'heading' => 'Bring your own engine',
            'text'    => 'Your team is familiar with Twig, Blade or your own template engine? No problem! Our engine can be swapped out with an existing plugin or you can even create your own.',
            'link'    => 'docs/reference/plugins/components/template'
          ]) ?>

        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Go headless',
          'id'         => 'api',
          'subheading' => 'Modern publishing possibilities at your fingertips'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'REST-ful by nature',
            'text'    => 'Use Kirby like a classic CMS or convert it into a powerful, headless content container. Connect it to mobile applications, static site generators or your custom frontend.',
            'link'    => 'docs/guide/api/introduction'
          ]) ?>

          <?= snippet('features/code', [
            'cols' => 4,
            'rows' => 6,
            'code' => $page->api(),
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Extensible',
            'text'    => 'Define your own API endpoints and objects. Integrate external data from databases, files or other APIs with data from Kirby into one seamless data-source.',
            'link'    => 'docs/reference/plugins/extensions/api'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Secure',
            'text'    => 'Use our built-in authentication methods to connect securely from the same server or a remote application.',
            'link'    => 'docs/guide/api/authentication'
          ]) ?>

        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Go global',
          'id'         => 'languages',
          'subheading' => 'Built-in internationalization'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'image'   => $page->image('languages.png'),
            'cols'    => 3,
            'rows'    => 3,
            'heading' => 'Language management',
            'text'    => 'Create new content languages right in the Panel and start translating your pages immediately. Start with a single language and move to multiple languages later, or go global immediately—it\'s up to your project.',
            'link'    => 'docs/guide/languages/introduction',
            'alt'     => 'Kirby\'s language manager in the Panel'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Create & Translate',
            'image'   => $page->image('translations.jpg'),
            'cols'    => 3,
            'rows'    => 3,
            'text'    => 'Internationalization is built into the core of Kirby. Switch intuitively between different language versions and translate your content together with your team or on your own.',
            'link'    => 'docs/guide/languages/translating-content',
            'alt'     => 'The translation switcher in the Panel'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Translatable URLs',
            'text'    => 'You can customize the main URL for each language, including subdomains. Combine this with translatable paths for pages to make your visitors feel at home.',
            'link'    => 'docs/guide/languages/translating-urls',
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Language detection',
            'text'    => 'Switch to automatic language detection and let Kirby figure out which language works best for your current visitor.'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Integrate',
            'text'    => 'Are you using a translation service like Memsource? Use the amazing Memsource plugin to import and export translations for your translators right from the Panel.',
            'link'    => 'https://github.com/OblikStudio/kirby-memsource'
          ]) ?>
        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'User management',
          'id'         => 'users',
          'subheading' => 'You are not alone in this'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/text', [
            'heading' => 'From the backend...',
            'text'    => 'The Panel offers you an easy way to manage your users and set up permissions based on different roles. Create different user types and store metadata to your users.',
            'link'    => 'docs/guide/users/managing-users',
          ]) ?>

          <?= snippet('features/image', [
            'image' => $page->image('users.jpg'),
            'cols'  => 4,
            'rows'  => 2,
            'link'  => 'docs/guide/users/managing-users',
            'alt'   => 'A screenshot of the user management in the Panel'
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
      </div>
    </section>

    <section class="features-section">
      <div class="wrap">
        <?= snippet('features/header', [
          'heading'    => 'Plugins',
          'id'         => 'plugins',
          'subheading' => 'Endless options for projects without roadblocks'
        ]) ?>

        <div class="features-grid">
          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('matomo.jpg'),
            'link'  => 'https://github.com/sylvainjule/kirby-matomo',
            'alt'   => 'A screenshot of the Matomo section plugin by Sylvain Julé'
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom sections',
            'text'    => 'Add entirely new interface elements to the Panel with custom sections. Integrate data from analytics tools, your ERM system, third-party services and more and use them seamlessly alongside your content. Use the power of Vue.js to create truly interactive plugins.',
            'link'    => 'https://getkirby.com/docs/reference/plugins/extensions/sections'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Routes',
            'text'    => 'Routing has never been easier: Kirby comes with a powerful router that can be extended to adjust the URL scheme, handle form submissions, add webhook endpoints or create virtual pages.',
            'link'    => 'docs/guide/routing'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Hooks',
            'text'    => 'React to specific events with hooks and trigger your own actions. Resize a file on upload, add data to a newly created page, add custom content validations and more.',
            'link'    => 'docs/reference/plugins/extensions/hooks'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Field methods',
            'text'    => 'Register additional methods to work with content fields. Transform content directly in your templates and clean up your template code along the way.',
            'link'    => 'docs/reference/plugins/extensions/field-methods'
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom fields',
            'text'    => 'Extend your forms with your own fields or use plugins from other developers. Data editing on steroids: locations, colors, annotations etc.',
            'link'    => 'docs/reference/plugins/extensions/fields'
          ]) ?>

          <?= snippet('features/image', [
            'cols'  => 4,
            'rows'  => 3,
            'image' => $page->image('locator.jpg'),
            'link'  => 'https://github.com/sylvainjule/kirby-locator',
            'alt'   => 'A screenshot of the Locator field plugin by Sylvain Julé'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Core components',
            'text'    => 'You don\'t like our template engine, Markdown parser or media API? Simply swap out major parts of the Kirby system with your own plugins.',
            'link'    => 'docs/reference/plugins/extensions/core-components'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'KirbyTags',
            'text'    => 'When Markdown isn\'t enough, add your own KirbyTags to simplify plain text formatting and to inject complex custom components into long-form text.',
            'link'    => 'docs/reference/plugins/extensions/kirbytags'
          ]) ?>

          <?= snippet('features/text', [
            'heading' => 'Caching',
            'text'    => 'Kirby comes with mighty caching on board. Not fitting for your project? Add your cache driver of choice and reduce page loading times in the blink of an eye.',
            'link'    => 'docs/guide/cache'
          ]) ?>

          <?= snippet('features/image', [
            'cols'   => 4,
            'rows'   => 3,
            'class'  => 'center',
            'image'  => $page->image('retour.jpg'),
            'link'   => 'https://github.com/distantnative/retour-for-kirby',
            'alt'    => 'A screenshot of the Retour view plugin by Nico Hoffmann'
          ]) ?>

          <?= snippet('features/text', [
            'rows'    => 3,
            'heading' => 'Custom views',
            'text'    => 'Add whole new views and menu items to the Panel. Use Vue.js to super-charge it as an admin framework for your own integrated applications.',
            'link'    => 'docs/reference/plugins/extensions/panel-views'
          ]) ?>

        </div>
      </div>
    </section>

    <div class="wrap">
      <div class="intro | -theme:dark">
          <?= kt('And so much more...
  Learn more about everything in our (link: docs text: Guide)') ?>
      </div>
    </div>

  </main>

<?php snippet('footer', ['theme' => 'dark']) ?>
