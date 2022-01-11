# Test your Livewire forms with Pest

This package provides a convenient way to test your Livewire forms and speed up your workflow. It adds helpers that make repetitive tasks faster, like testing whether properties are required or not.

## Contents

1. Expectations
    1. [expect(...)->toHaveRequiredProperties()](#expect-tohaverequiredproperties)
    1. [expect(...)->toNotHaveRequiredProperties()](#expect-tonothaverequiredproperties)
1. Functions
    1. [assertRequiredProperties](#assertrequiredproperties)
    1. [assertNotRequiredProperties](#assertnotrequiredproperties)
    1. [validInput](#validinput)

## Expectations

### expect(...)->toHaveRequiredProperties()

Test whether Livewire properties are required. Consider the following dummy Livewire component:

```php
class TestRequiredPropertiesComponent extends Component
{
    public string $email_Req = '';
    public string $email = '';
    public ?int $age_Req = null;
    public ?int $age = null;

    protected array $rules = [
        'email' => '',
        'email_Req' => 'required',
        'age' => 'numeric',
        'age_Req' => 'numeric|required',
    ];

    public function render(): string
    {
        return '<div></div>';
    }

    public function submit()
    {
        $this->validate();
    }
```

```php
use function RalphJSmit\PestPluginLivewire\validInput;

$component = Livewire::test(TestRequiredPropertiesComponent::class);

$validInput = validInput([
    'email' => 'alex@example.com',
    'age' => 25,
]);

expect($component)
    ->toHaveRequiredProperties(validInput, ['email_Req', 'age_Req'], 'submit');
```

### expect(...)->toNotHaveRequiredProperties()

Test whether Livewire properties aren't required. Let's continue the example from above with a test for the properties that are not required:

```php
use function RalphJSmit\PestPluginLivewire\validInput;

$component = Livewire::test(TestRequiredPropertiesComponent::class);

$validInput = validInput([
    'email' => 'alex@example.com',
    'age' => 25,
]);

expect($component)
    ->toNotHaveRequiredProperties(validInput, ['email', 'name'], 'submit');
```

## Functions

### assertRequiredProperties()

Use this function to test whether Livewire properties are required. Consider using an `expect(...)` call if you want to chain multiple expectations:

```php
use function RalphJSmit\PestPluginLivewire\assertRequiredProperties;

assertRequiredProperties(TestableLivewire $livewire, Collection $validInput, array $requiredProperties, string $submitFunction);
```

### assertNotRequiredProperties()

Use this function to test whether Livewire properties aren't required. Consider using an `expect(...)` call if you want to chain multiple expectations:

```php
use function RalphJSmit\PestPluginLivewire\assertNotRequiredProperties;

assertNotRequiredProperties(TestableLivewire $livewire, Collection $validInput, array $requiredProperties, string $submitFunction);
```

### validInput()

Use this function to get a `ValidInput` object (Laravel Collection). It's needed for using the above functions.

## General

🐞 If you spot a bug, please submit a detailed issue and I'll try to fix it as soon as possible.

🔐 If you discover a vulnerability, please review [our security policy](../../security/policy).

🙌 If you want to contribute, please submit a pull request. All PRs will be fully credited. If you're unsure whether I'd accept your idea, feel free to contact me!

🙋‍♂️ [Ralph J. Smit](https://ralphjsmit.com)
