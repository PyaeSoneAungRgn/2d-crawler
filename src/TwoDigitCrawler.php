<?php

namespace PyaeSoneAung\TwoDigitCrawler;

use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class TwoDigitCrawler
{
    protected $set;

    protected $val;

    protected $status;

    public function __construct()
    {
        [$this->set, $this->val, $this->status] = $this->getValuesFromSite();
    }

    public function getSet(): string
    {
        return $this->set;
    }

    public function getVal(): string
    {
        return $this->val;
    }

    public function getNumber(): string
    {
        $number = '';
        $number .= substr($this->set, -1);
        $number .= substr(strstr($this->val, '.', true), -1);

        return $number;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    private function getValuesFromSite(): array
    {
        $html = $this->runBrowsershot();
        $dom = $this->convertHtmlToDom($html);

        return $this->filterValues($dom);
    }

    private function runBrowsershot(): string
    {
        return Browsershot::url('https://www.set.or.th/th/market/product/stock/overview')
            ->noSandbox()
            ->waitUntilNetworkIdle()
            ->bodyHtml();
    }

    private function convertHtmlToDom(string $html): DomCrawler
    {
        return new DomCrawler($html);
    }

    private function filterValues(DomCrawler $dom): array
    {
        $set = $dom->filter('tr.table-active td')->eq(1)->text();
        $val = $dom->filter('tr.table-active td')->eq(7)->text();
        $status = $dom->filter('div > small.text-end')->text();
        $status = trim(substr($status, strpos($status, ':') + 1));

        return [$set, $val, $status];
    }
}
