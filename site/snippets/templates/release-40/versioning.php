<style>

.diff {
  display: flex;
  flex-direction: column;
}

.diff-table {
  table-layout: fixed;
  align-self: flex-end;
  margin-bottom: var(--spacing-6);
}

.diff-table.old {
  color: var(--color-red-500);
}
.diff-table.new {
  color: var(--color-green-400);
}

.diff-table th,
.diff-table td {
  position: relative;
  font-weight: normal;
  width: 6rem;
}
.diff-table th:not(:last-child):after,
.diff-table td:not(:last-child):after {
  position: absolute;
  content: ".";
  right: 1rem;
  color: var(--color-gray-600);
}

.diff-table.new th:first-child:after,
.diff-table.new td:first-child:after {
  display: none;
}

.diff-table .generation {
  width: 10rem;
}

.diff-table del {
  color: var(--color-gray-700);
}

.diff-table caption {
  color: var(--color-gray-500);
  text-align: left;
}
.diff-table caption::before {
  content: "// "
}

.release-code-box ul {
  list-style:disc;
  margin-left: 1ch;
}
</style>

<section id="versioning" class="mb-36">

  <?php snippet('hgroup', [
    'title'    => 'New Versioning Scheme',
  ]) ?>

  <div class="columns" style="--columns: 2">
    <div class="release-code-box diff-box p-12">
      <div class="code diff font-mono">
        <table class="diff-table old">
          <caption>before</caption>
          <tr>
            <th class="generation">{generation}</th>
            <th>{major}</th>
            <th>{minor}</th>
            <th>{patch}</th>
          </tr>
          <tr>
            <td class="generation">3</td>
            <td>9</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td class="generation">3</td>
            <td>10</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td class="generation">3</td>
            <td>11</td>
            <td>0</td>
            <td>0</td>
          </tr>
        </table>
        <table class="diff-table new">
          <caption>after</caption>
          <tr>
            <th class="generation"><del>{generation}</del></th>
            <th>{major}</th>
            <th>{minor}</th>
            <th>{patch}</th>
          </tr>
          <tr>
            <td><del>3</del> &rarr;</td>
            <td>3</td>
            <td>9</td>
            <td>0</td>
          </tr>
          <tr>
            <td></td>
            <td>4</td>
            <td>0</td>
            <td>0</td>
          </tr>
          <tr>
            <td></td>
            <td>5</td>
            <td>0</td>
            <td>0</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="release-code-box p-12 font-mono color-white">
      <div>
        <h4 class="mb-3" style="color: var(--color-purple-400)">Key points</h4>
        <ul class="mb-12">
          <li>Kirby will follow semantic versioning</li>
          <li>Major versions will no longer be paid upgrades</li>
          <li>Major versions will be released on a yearly cycle to bring continuity and planning security.</li>
        </ul>

        <h4 class="mb-3" style="color: var(--color-purple-400)">Example roadmap</h4>
        <ul>
          <li>4.0.0: late summer 2023</li>
          <li>5.0.0: late summer 2024</li>
          <li>6.0.0: late summer 2025</li>
        </ul>
      </div>
    </div>
  </div>
</section>
