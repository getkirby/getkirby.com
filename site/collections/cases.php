<?php

return function ($site) {

    $cases = $site
        ->find('love')
        ->children()
        ->listed();

    $partnerGallery = $site
        ->find('partners')
        ->grandChildren()
        ->filterBy('showcase', true)
        ->filterBy('link', 'not in', $cases->pluck('link', ','));


    return $cases
        ->add($partnerGallery);
};
