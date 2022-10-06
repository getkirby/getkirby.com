<section id="contributors" class="mb-42 text-center">
  <h2 class="h2 mb-6">Contributors</h2>

  <div class="place-items-center">
    <ul class="max-w-xl flex flex-wrap justify-center">
      <?php foreach ([
        'afbora',
        'bastianallgeier',
        'distantnative',
        'lukasbestle',
        'neildaniels',
        'seb-celinedesign',
        'sebastiangreger'
      ] as $contributor): ?>
      <li class="inline-flex p-1">
        <a href="https://github.com/<?= $contributor ?>" class="p-3 text-sm font-mono shadow bg-white rounded flex items-center">
          <img src="https://github.com/<?= $contributor ?>.png?size=64" style="border-radius: 100%; width: auto" class="mr-3" width="32" height="32" loading="lazy"> @<?= $contributor ?>
        </a>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
</section>
