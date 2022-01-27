<?php

class PluginDeveloperPage extends Page
{

    public function avatar()
    {
        return $this->image('avatar.png');
    }

    public function github()
    {
        return parent::github()->or('https://github.com/' . $this->slug());
    }

    public function githubAvatar(int $size = 400)
    {
        return $this->github() . '.png?size=' . $size;
    }

}
