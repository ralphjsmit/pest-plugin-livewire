# Test your Livewire forms with Pest

## Contents

1. Expectations
    1. [expect(...)->toHaveContents()](#expect-tohavecontents)
    2. [expect(...)->toExist()](#expect-toexist)
    3. [expect(...)->toHaveNamespace()](#expect-tohavenamespace)
2. Higher-order expectations
    1. [expect(...)->contents->toBe(...)](#expect-contents-tobe)
3. Functions
    1. [rm($path, $allowNonExisting)](#rmpath-allownonexisting)
    2. [rmdir_recursive($dir)](#rmdir_recursivedir)
    3. [contents($path)](#contentspath)
    4. [expectFailedAssertion()](#expectfailedassertion)

## Expectations

### expect(...)->toHaveContents()

Test whether a file has certain contents:

```php
file_put_contents(__DIR__ . '/tmp/fileA.php', 'I\'m a test file!');
file_put_contents(__DIR__ . '/tmp/fileB.php', 'I\'m a second test file!');

expect(__DIR__ . '/tmp/fileA.php')->toHaveContents('I\'m a test file!');
expect(__DIR__ . '/tmp/fileB.php')->not->toHaveContents('I\'m a test file!');
```

## General

🐞 If you spot a bug, please submit a detailed issue and I'll try to fix it as soon as possible.

🔐 If you discover a vulnerability, please review [our security policy](../../security/policy).

🙌 If you want to contribute, please submit a pull request. All PRs will be fully credited. If you're unsure whether I'd accept your idea, feel free to contact me!

🙋‍♂️ [Ralph J. Smit](https://ralphjsmit.com)
