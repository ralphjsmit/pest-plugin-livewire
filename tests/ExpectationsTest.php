<?php

use Livewire\Livewire;
use RalphJSmit\PestPluginLivewire\Tests\Fixtures\TestRequiredPropertiesComponent;

use function RalphJSmit\PestPluginLivewire\validInput;

beforeEach(function () {
    Livewire::component('test-component-create', TestRequiredPropertiesComponent::class);
});

it('can correctly assert whether a property is required or not', function (string $componentId) {
    $component = Livewire::test($componentId);

    $validInput = validInput([
        'email' => 'alex@example.com',
        'age' => 25,
        'name' => 'Alex',
        'company' => 'My Company',
    ]);

    expect($component)
        ->toHaveRequiredProperties($validInput, ['email_Req', 'name_Req', 'age_Req', 'company_Req', 'workExperience_Req'], 'submit')
        ->toNotHaveRequiredProperties($validInput, ['email', 'name', 'age', 'company', 'workExperience'], 'submit')
        ->not->toNotHaveRequiredProperties($validInput, ['email_Req', 'name_Req', 'age_Req', 'company_Req', 'workExperience_Req'], 'submit')
        ->not->toHaveRequiredProperties($validInput, ['email', 'name', 'age', 'company', 'workExperience'], 'submit');
})->with([
    [TestRequiredPropertiesComponent::class],
    ['test-component-create'],
]);