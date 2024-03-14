<?php

use Livewire\Livewire;
use RalphJSmit\PestPluginLivewire\Tests\Fixtures\TestRequiredPropertiesComponent;

use function RalphJSmit\PestPluginLivewire\assertNotRequiredProperties;
use function RalphJSmit\PestPluginLivewire\assertRequiredProperties;
use function RalphJSmit\PestPluginLivewire\validInput;

beforeEach(function () {
    Livewire::component('test-component-create', TestRequiredPropertiesComponent::class);
});

it('can correctly return valid input ', function () {
    $validInputCollection = validInput([
        'name' => 'John',
        'age' => 25,
        'email' => 'john@example.com',
    ]);

    $this->assertSame([
        'name' => 'John',
        'age' => 25,
    ], $validInputCollection->only(['name', 'age'])->all());

    $this->assertSame([
        'name' => 'John',
        'age' => 25,
    ], $validInputCollection->except(['email'])->all());
});

it('can correctly assert whether a property is required or not', function (string $componentId) {
    $component = Livewire::test($componentId);

    $validInput = validInput([
        'email' => 'alex@example.com',
        'email_Req' => 'alex@example.com',
        'age' => 25,
        'age_Req' => 25,
        'name' => 'Alex',
        'name_Req' => 'Alex',
        'company' => 'My Company',
        'company_Req' => 'My Company',
    ]);

    assertRequiredProperties($component, $validInput, ['email_Req', 'name_Req', 'age_Req', 'company_Req', 'workExperience_Req'], 'submit');
    assertNotRequiredProperties($component, $validInput, ['email', 'name', 'age', 'company', 'workExperience'], 'submit');
})->with([
    [TestRequiredPropertiesComponent::class],
    ['test-component-create'],
]);
