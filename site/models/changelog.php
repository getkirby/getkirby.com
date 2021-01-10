<?php

use Kirby\Cms\Page;

class ChangeLogPage extends Page
{

    protected $changelog = null;
    protected $paginated = null;

    public function perPage()
    {
        return 10;
    }

    public function changelog()
    {
        if (is_null($this->changelog)) {
            $this->changelog = $this->children()->listed()->flip();
        }
        return $this->changelog;
    }

    public function changelogPaginated()
    {
        if (is_null($this->paginated)) {
            $this->paginated = $this->changelog()->paginate($this->perPage());
        }
        return $this->paginated;
    }

    /**
    * Get the page number of a version entry
    */
    public function getVersionPageNum($version)
    {
        $versions = $this->changelog();
        $i        = 0;

        foreach($versions as $item) {
            if ($item === $version) {
                return floor($i / $this->perPage()) + 1;
            }
            $i++;
        }
    }

}
