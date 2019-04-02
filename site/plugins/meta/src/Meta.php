<?php

namespace Kirby\Meta;
// use Kirby\Toolkit\Obj;
use Kirby\Toolkit\Str;

class Meta /*extends Obj*/ {

  protected $page;
  protected $data = [];

  public function __construct($page) {
    $this->page = $page;

  }

  public function hasOwnDescription(): bool
  {
    return $this->page->description()->isNotEmpty();
  }

  public function description(): string
  {
    if ($this->hasOwnDescription() === true) {
      return $this->page->description()->value();
    }

    if ($this->text()->isNoteEmpty()) {
      return Str::excerpt($this->text()->kirbytext()->value(), 160);
    }

    return site()->description()->value();
  }

  public function hasOwnImage(): bool
  {
    return $this->ogimage()->toFile() !== false;
  }

  public function image()
  {
    if ($image = $this->ogimage()->toFile()) {
      return $image;
    }

    return site()->ogimage()->toFile();
  }
}
