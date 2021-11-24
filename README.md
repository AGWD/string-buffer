# StringBuffer
Manipulate strings similarly to Java StringBuffer.

## Installation
The preferred method of installation is via Packagist and Composer. Run the following command to install the package and add it as a requirement to your project's composer.json:

```
composer require adriangreen/string-buffer
```

## Examples
```php
<?php
use Simlux\String\StringBuffer();

$buffer = new StringBuffer('test');
$buffer->append('bar');
$buffer->prepend('foo');
echo $buffer->toString(); // footestbar

// with factory method
StringBuffer::create('Test') // Test
    ->append('Bar')          // TestBar 
    ->prepend('Foo');        // FooTestBar
    
StringBuffer::create('Test')                    // Test 
    ->appendIf(true, 'AppendIf', 'AppendElse'); // TestAppendIf
StringBuffer::create('Test')                     // Test
    ->appendIf(false, 'AppendIf', 'AppendElse'); // TestAppendElse

StringBuffer::create('Test')                       // Test
    ->prependIf(true, 'PrependIf', 'PrependElse'); // PrependIfTest
StringBuffer::create('Test')                        // Test
    ->prependIf(false, 'PrependIf', 'PrependElse'); // PrependElseTest
    
StringBuffer::create('Test') // Test
    ->replace('es', 'ES');   // TESt
    
StringBuffer::create('Test') // Test
    ->remove('es');          // Tt
```
