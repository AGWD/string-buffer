# StringBuffer

Manipulate strings similarly to Java StringBuffer.

## Installation

For my own use and not on Packagist. 

Add to composer.json:
```
    "require": {
        "adriangreen/string-buffer": "^1",
        ...
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/agwd/string-buffer.git"
        },
        ...
    ]
```

## Examples

```php
<?php
use AdrianGreen\String\StringBuffer();

$buffer = new StringBuffer('test');
$buffer->append('bar');
$buffer->prepend('foo');
echo $buffer->toString();    // footestbar

// with factory method
StringBuffer::create('Test') // Test
    ->append('Bar')          // TestBar 
    ->prepend('Foo');        // FooTestBar
    
StringBuffer::create('Test')                        // Test 
    ->appendIf(true, 'AppendIf', 'AppendElse');     // TestAppendIf
StringBuffer::create('Test')                        // Test
    ->appendIf(false, 'AppendIf', 'AppendElse');    // TestAppendElse

StringBuffer::create('Test')                        // Test
    ->prependIf(true, 'PrependIf', 'PrependElse');  // PrependIfTest
StringBuffer::create('Test')                        // Test
    ->prependIf(false, 'PrependIf', 'PrependElse'); // PrependElseTest
    
StringBuffer::create('Test') // Test
    ->replace('es', 'ES');   // TESt
    
StringBuffer::create('Test') // Test
    ->remove('es');          // Tt
```
