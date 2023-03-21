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

<section id="roadmap" class="mb-36">
  <?php snippet('templates/features/intro', [
    'title' => 'ETA',
    'text'  => 'We roughly plan with the following schedule for v4. The success of the beta and your input will determine the final release date.'
  ]) ?>
  <ul class="roadmap flex justify-between mb-24">
    <li style="flex-grow: 1">
      <p class="h4">Announcement</p>
      <p class="font-mono text-xs">March 2023</p>
    </li>
    <li style="flex-grow: 4">
      <p class="h4">Open Beta</p>
      <p class="font-mono text-xs">May 2012</p>
    </li>
    <li style="flex-grow: 1">
      <p class="h4">Release</p>
      <p class="font-mono text-xs">Late summer 2023</p>
    </li>
    <li></li>
  </ul>
</section>
