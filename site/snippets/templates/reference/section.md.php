<?php

echo markdownHeading($section->title(), $headingLevel ?? 3);
echo markdownLinkList($section->children());
