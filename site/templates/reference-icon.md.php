<?php
/**
 * @var ReferenceIconPage $page
 */

layout('reference.md');

$intro = $page->intro()->unhtml();

slot('intro');

echo cleanUpMarkdown(<<<MARKDOWN

```html
$intro
```

MARKDOWN);

endslot();
