<?php

namespace Kirby\Reference;

class ReflectionSection extends ReflectionPage
{
    /**
     * Whether to show 2nd sidebar in Reference to select items
     * and navigate easily between siblings
     *
     * @return bool
     */
    public function hasSelector(): bool
    {
        return false;
    }

    public function template()
    {
        // If template exists, use it
        if ($this->intendedTemplate() === parent::template()) {
            return parent::template();
        }

        return $this->kirby()->template('reference.section');
    }
}
