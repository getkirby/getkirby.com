<?php

echo markdownHeading($section->title(), $headingLevel ?? 3);
echo markdownLink($section->title(), $section->markdownUrl());
