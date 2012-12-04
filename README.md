# Number mather with simple patterns

## Installation

Run in your project root:

```composer require rithis/number-matcher:@dev```


## Usage

```php
<?php

$numberMatcher = new Rithis\NumberMatcher\NumberMatcher('ABC-ABC');
$numberMatcher->match('123-123'); // true
$numberMatcher->match('123-321'); // false
```

## Pattern structure

* `X` - any digit;
* `A`, `B`, `C`, etc. - unique digit;
* other - required symbol.
