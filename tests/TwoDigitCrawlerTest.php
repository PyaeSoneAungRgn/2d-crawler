<?php

it('can crawl', function () {
    $crawler = crawler();
    expect($crawler->getSet())->toBeString();
    expect($crawler->getVal())->toBeString();
    expect($crawler->getNumber())->toBeString();
    expect($crawler->getStatus())->toBeString();
});
