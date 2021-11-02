<style>
.roadmap {
  position: relative;
}
.roadmap::after,
.roadmap li::after {
  position: absolute;
  left: 1.5rem;
  right: 0;
  bottom: -.75rem;
  content: "";
  height: 2px;
  background: var(--color-black);
}
.roadmap li {
  position: relative;
}
.roadmap li::after {
  width: 2px;
  height: .75rem;
  right: auto;
}
.roadmap li:last-child::after {
  background: none;
  left: auto;
  right: 0;
  width: auto;
  height: auto;
  bottom: calc(-.75rem - 5px);
  border-top: 6px solid transparent;
  border-left: 6px solid var(--color-black);
  border-bottom: 6px solid transparent;
}
</style>

<section id="roadmap" class="mb-42">

  <style>
    @media (min-width: 65rem) {
      .introduction {
        columns: 2;
        column-gap: var(--spacing-24);
      }
    }

    .introduction p {
      max-width: none;
    }
  </style>

  <div class="prose bg-white p-12 shadow-xl text-xl mb-24 introduction">
    <p>We started working on Kirby 3.6 in April and we are finally about to release it very soon.</p>
    <p>This release is maybe the most important one since 3.0. The v3 foundation is still holding up and we see endless possibilities to extend it and keep it growing. But we also wanted to make sure that we don't carry along old baggage. We've learned a ton from all the projects you build and the plugins you develop, and there were things in our architecture that could have been better, simpler – more aligned with Kirby's philosophy.</p>
    <p>With 3.6, we get rid of the bad parts and move forward with fantastic new parts. 3.6 is the door opener for all your feature requests that are currently blocked. It is the foundation for the coming years and we couldn't be more proud of it.</p>
    <p>We are now in the final phase before the release. Jump on board and help us test <a href="<?= $page->link() ?>"><?= $page->title() ?></a></p>
    <p>We hope you'll enjoy it!</p>
    <p><strong>– The Kirby team</strong></p>
  </div>
  <ul class="roadmap flex justify-between mb-24">
    <li>
      <p class="h2">alpha</p>
      <p class="font-mono text-xs">July 2nd</p>
    </li>
    <li>
      <p class="h2">beta</p>
      <p class="font-mono text-xs">September 21st</p>
    </li>
    <li>
      <p class="h2">launch</p>
      <p class="font-mono text-xs">November</p>
    </li>
    <li></li>
  </ul>
</section>
