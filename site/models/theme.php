<?php

class ThemePage extends Page
{

    public function prio()
    {
        return parent::prio()->or(9999);
    }

}
