<?php

namespace PyaeSoneAung\TwoDigitCrawler;

use Symfony\Component\BrowserKit\HttpBrowser;

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
        $client = new HttpBrowser();
        $dom = $client->request('GET', 'https://www.set.or.th/th/market/product/stock/overview');

        return $this->filterValues($dom);
    }

    private function filterValues($dom): array
    {
        $cols = $dom->filter('div.table-index-overview')
            ->filter('table')
            ->eq(1)
            ->filter('tr')
            ->eq(1)
            ->filter('td');
        $set = $cols->eq(1)->text();
        $val = $cols->eq(7)->text();
        $status = $dom->filter('div > small.text-end')->text();
        $status = trim(substr($status, strpos($status, ':') + 1));

        return [$set, $val, $status];
    }
}
