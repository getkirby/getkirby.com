<?php snippet('header') ?>

  <main class="buy-page | main" id="maincontent">
    <article>
      <div class="wrap">
        <?php snippet('hero', ['align' => 'center']) ?>
        <div class="pricing">
          <section>

            <?php if (empty($sale) === false): ?>
            <h2 class="h1 -mb:0"><del>€<?= $price ?></del> €<?= $sale ?> <small>per site</small></h2>
            <?php else: ?>
            <h2 class="h1 -mb:0">€<?= $price ?> <small>per site</small></h2>
            <?php endif ?>

            <p class="vat description">
              + VAT if applicable
            </p>
            <p class="text">We like to keep things simple: One price, all features, no fees, no subscription.</p>
            <?php if (empty($saleText) === false): ?>
            <p class="text sale"><?= $saleText ?></p>
            <?php endif ?>
            <p>
              <a id="cta" href="https://pay.paddle.com/checkout/499826" target="_blank" class="cta">
                <?php icon('cart') ?>
                Buy now
              </a>
            </p>

          </section>
        </div>
      </div>
      <section class="section -background:light">
        <div class="wrap">
          <h2 class="h1 -align:center">FAQ</h2>
          <ul class="faq multicol">
            <?php foreach ($page->find('answers')->children()->listed() as $question): ?>
            <li>
              <h3 id="<?= $question->slug() ?>"><?= $question->title()->widont() ?></h3>
              <div class="description text">
                <?= $question->text()->kt() ?>
              </div>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>
    </article>
  </main>

  <script src="https://cdn.paddle.com/paddle/paddle.js"></script>
  <script type="text/javascript">
   Paddle.Setup({
      vendor: 1129,
    });


    document.getElementById("cta").addEventListener("click", function (e) {
      e.preventDefault();

      var params = {
        product: 499826
      };

      // try to get affiliate id from session storage
      var affiliate_id = sessionStorage.getItem("kirby_affiliate_id");

      if (affiliate_id !== null) {
        params["affiliates"] = [affiliate_id];
      }

      console.log("params", params);

      Paddle.Checkout.open(params);
    }, false);
  </script>

<?php snippet('footer') ?>
