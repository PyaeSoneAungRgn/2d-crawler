[![Run tests](https://github.com/PyaeSoneAungRgn/2d-crawler/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/PyaeSoneAungRgn/2d-crawler/actions/workflows/run-tests.yml)

# 2D Crawler

2D crawler for [set.or.th](https://www.set.or.th/th/market/product/stock/overview)

## Installation

```bash
composer require pyaesoneaung/2d-crawler
```

## Usage

```php
use PyaeSoneAung\TwoDigitCrawler\TwoDigitCrawler;

$twoDigit = new TwoDigitCrawler;

$twoDigit->getSet(); // "1,685.75"
$twoDigit->getVal(); // "63,797.02"
$twoDigit->getNumber(); // "57"
$twoDigit->getStatus(); // "Closed"
```

## Testing

```bash
composer test
```
