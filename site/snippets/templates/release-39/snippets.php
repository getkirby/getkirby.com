<section id="snippets" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'Snippets with slots',
    'subtitle' => 'Templating on another level',
    'mb'       => 12
  ]) ?>

  <div class="columns mb-6" style="--columns: 2">
    <div class="release-code-box">
      <?= $page->snippetsA()->kt() ?>
    </div>

    <div class="release-code-box">
      <?= $page->snippetsB()->kt() ?>
    </div>
  </div>

  <div class="columns" style="--columns: 3">
    <div class="release-text-box">
      <div class="prose">
        Donec id elit non mi porta gravida at eget metus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo.
      </div>
    </div>
    <div class="release-text-box">
      <div class="prose">
        Donec id elit non mi porta gravida at eget metus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo.
      </div>
    </div>
    <div class="release-text-box">
      <div class="prose">
        Donec id elit non mi porta gravida at eget metus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean lacinia bibendum nulla sed consectetur. Nullam quis risus eget urna mollis ornare vel eu leo.
      </div>
    </div>
  </div>

</section>
