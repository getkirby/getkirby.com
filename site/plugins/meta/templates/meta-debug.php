<?php snippet('header') ?>

<main class="main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>
      <div class="text">
        <style>
        #meta-debug-table td {
          background: white;
        }
        </style>

        <button type="button" id="meta-check-links">Check for broken links (and grab some ☕️)!</button>
        <pre id="meta-check-status">–</pre>
        <br><br>

        <table id="meta-debug-table">
            <thead>
                <tr>
                    <th style="vertical-align: bottom;" width="100">Template</th>
                    <th style="vertical-align: bottom;">Opengraph title</th>
                    <th style="vertical-align: bottom;">Description</th>
                    <th style="vertical-align: bottom;" width="120">Thumbnail</th>
                    <th style="writing-mode: vertical-lr;" width="40">Has own description</th>
                    <th style="writing-mode: vertical-lr;" width="40">Has own thumbnail</th>
                    <th style="writing-mode: vertical-lr;" width="40">Thumbnail alt text</th>
                    <th style="writing-mode: vertical-lr;" width="40">All links working</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach (site()->index() as $item) {

                    if ($item->template()->name() === 'link') {
                        continue;
                    }

                    $meta = $item->meta();

                    echo '<tr class="meta-debug-header--' . $item->id() . '">';
                        echo '<th colspan="8" style="background: #efefef">' . $item->title()->link() . ' <code class="meta-debug-page-id">' . $item->id() . '</code></th>';
                    echo '</tr>';

                    echo '<tr class="meta-debug-details--' . $item->id() . '">';
                    
                    echo '<td>' . $item->template()->name() . '</td>';
                    
                    echo '<td>' . $meta->ogtitle()->html() . '</td>';
                    
                    
                    echo '<td>' . $meta->description()->html() . '</td>';
                    
                    
                    echo '<td>' . $meta->thumbnail() . '</td>';
                    
                    echo '<td>' . ($meta->hasOwnDescription() ? '✅' : '❌') . '</td>';
                    echo '<td>' . ($meta->hasOwnThumbnail() ? '✅' : '❌') . '</td>';

                    $thumbnail = $meta->thumbnail();
                    echo '<td>' . ($thumbnail !== null && $thumbnail->alt()->isNotEmpty() ? '✅' : '❌') . '</td>';

                    echo '<td class="meta-debug-boken-links">❔</td>'; // ' . ($thumbnail !== null && $thumbnail->alt()->isNotEmpty() ? '✅' : '❌') . ' 🔸

                    echo '</tr>';

                    echo '<tr class="meta-debug-message--' . $item->id() . '" hidden>';
                        echo '<td colspan="8" style="background: #fafafa"><pre></pre></td>';
                    echo '</tr>';
                }

                ?>
            </tbody>
        </table>
      </div>
    </article>
  </main>

  <script>
  (function() {

    class Queue {
      constructor() {
        this._queue = [];
        this._ongoingCount = 0;
        this._concurrency = 5;
      }

      add(fn) {
        new Promise((resolve, reject) => {

          const run = () => {
            this._ongoingCount++;
            fn().then(
              (val) => {
                resolve(val);
                this._next();
              },
              (err) => {
                reject(err);
                this._next();
              },
            );
          }

          if (this._ongoingCount < this._concurrency) {
            run();
          } else {
            this._queue.push(run);
          }
        });
        return this;
      }

      waitingCount() {
        return this._queue.length;
      }

      ongoingCount() {
        return this._ongoingCount;
      }

      _next() {
        this._ongoingCount--;

        if (this._queue.length > 0) {
          const firstQueueTask = this._queue.shift();
          if (firstQueueTask) {
            firstQueueTask();
          }
        }
      }
    }
    
    const linkCheckButton = document.getElementById("meta-check-links");
    
    linkCheckButton.onclick = function() {
      this.disabled = true;

      const siteUrl   = <?= json_encode(url()) ?>;
      const pageIds = document.querySelectorAll("#meta-debug-table th .meta-debug-page-id");
      const linkCheckOutput = document.getElementById("meta-check-status");
      const queue = new Queue();

      let alreadyChecked = 0;
      let brokenLinksFound = 0;

      const checkPage = function(id) {

        const url = new URL(`${siteUrl}/meta-check-page`);
        url.searchParams.append("id", id);
        
        const idEscaped = id.replace(/(\/|@)/g, "\\$1");
        const icon = document.querySelector(`.meta-debug-details--${idEscaped} .meta-debug-boken-links`);
        const message = document.querySelector(`.meta-debug-message--${idEscaped}`);
        const messageOutput = document.querySelector(`.meta-debug-message--${idEscaped} pre`);
        
        icon.textContent = '🔸';

        

        return fetch(url, {
            cache: "no-store",
          })
          .then((response) => response.json())
          .then((result) => {
            linkCheckOutput.innerHTML = `${++alreadyChecked}/${pageIds.length} pages checked.<br>${brokenLinksFound} broken links found so far`;

            if (result.message !== null) {
              message.hidden = false;
              messageOutput.textContent = result.message;
              icon.textContent = "❌";
            } else {
              icon.textContent = "✅";
            }

            if (result.type === 'redirect') {
              icon.textContent = '➡️';
            }

            if(typeof result.brokenLinks !== "undefined") {
              brokenLinksFound += result.brokenLinks.length;
            }
          });
      }

      for (let i = 0, l = pageIds.length; i < l; i++) {
        queue.add(() => checkPage(pageIds[i].innerHTML));
      }
    }
  
  })();
  </script>
<?php snippet('footer') ?>
