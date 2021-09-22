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
    <p>We started working on Kirby 3.6 in April and want to take you with us on our journey from now on.</p>
    <p>This release is maybe the most important one since 3.0. The v3 foundation is still holding up and we see endless possibilities to extend it and keep it growing. But we also want to make sure that we don't carry along old baggage. We've learned a ton from all the projects you build and the plugins you develop, and there are things in our architecture that could be better, simpler – more aligned with Kirby's philosophy.</p>
    <p>With 3.6, we want to get rid of the bad parts and move forward with some fantastic new parts. 3.6 is the door opener for all your feature requests that are currently blocked. We don't want to think about Kirby 4 right now. We want to make Kirby 3 even more awesome and more stable – for years to come.</p>
    <p>We are taking some bigger steps with this release that introduce breaking changes. That's why we want you to have full insight in our roadmap, in the state of the alpha and beta and hear your feedback as early as possible.</p>
    <p>We hope you'll enjoy the beta!</p>
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
      <p class="font-mono text-xs">October</p>
    </li>
    <li></li>
  </ul>
</section>
