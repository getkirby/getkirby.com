<style>
.workflow li {
  height: 6rem;
}
@media screen and (max-width: 40rem) {
  .workflow {
    margin-left: calc(-1 * var(--container-padding) + .75rem);
    margin-right: 2rem;
  }
  .workflow li svg {
    width: 3rem;
    height: 3rem;
  }
}
.workflow figure {
  position: relative;
  display: inline-flex;
}
.workflow figcaption {
  position: absolute;
  top: 100%;
  margin-top: -.75rem;
  margin-left: -.75rem;
  left: 100%;
}
.workflow svg * {
  fill: var(--color-gray-300);
}
</style>

<ul class="workflow">
  <li style="margin-left: 20%">
    <figure>
      <?= image('bulb.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-purple-500)">Idea</figaption>
    </figure>
  </li>
  <li style="margin-left: 60%">
    <figure>
      <?= image('pen.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-blue-500)">Concept</figaption>
    </figure>
  </li>
  <li style="margin-left: 0%; margin-top: -6rem">
    <figure>
      <?= image('research.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-green-500)">Research</figaption>
    </figure>
  </li>
  <li style="margin-left: 40%">
    <figure>
      <?= image('prototype.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-red-500)">Prototyping</figaption>
    </figure>
  </li>
  <li style="margin-left: 80%">
    <figure>
      <?= image('screen.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-aqua-500)">Design</figaption>
    </figure>
  </li>
  <li style="margin-left: 20%; margin-top: -6rem">
    <figure>
      <?= image('code.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-orange-500)">Development</figaption>
    </figure>
  </li>
  <li style="margin-left: 60%">
    <figure>
      <?= image('rocket.svg')->read() ?>
      <figcaption class="badge" style="color: var(--color-yellow-300)">Shipping</figaption>
    </figure>
  </li>

</ul>
