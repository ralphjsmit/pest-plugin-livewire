<?php

use Livewire\Livewire;
use RalphJSmit\PestPluginLivewire\Tests\Fixtures\TestRequiredPropertiesComponent;
use RalphJSmit\PestPluginLivewire\Tests\Fixtures\TestRequiredPropertiesComponentWithDataStatepath;

use function RalphJSmit\PestPluginLivewire\validInput;

beforeEach(function () {
    Livewire::component('test-component-create', TestRequiredPropertiesComponent::class);
    Livewire::component('test-component-create-statepath', TestRequiredPropertiesComponentWithDataStatepath::class);
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

it('can correctly assert whether a property is required or not with the data statepath', function (string $componentId) {
    $component = Livewire::test($componentId);

    $validInput = validInput([
        'data.email' => 'alex@example.com',
        'data.age' => 25,
        'data.name' => 'Alex',
        'data.company' => 'My Company',
    ]);

    expect($component)
        ->toHaveRequiredProperties($validInput, ['data.email_Req', 'data.name_Req', 'data.age_Req', 'data.company_Req', 'data.workExperience_Req'], 'submit')
        ->toNotHaveRequiredProperties($validInput, ['data.email', 'data.name', 'data.age', 'data.company', 'data.workExperience'], 'submit')
        ->not->toNotHaveRequiredProperties($validInput, ['data.email_Req', 'data.name_Req', 'data.age_Req', 'data.company_Req', 'data.workExperience_Req'], 'submit')
        ->not->toHaveRequiredProperties($validInput, ['data.email', 'data.name', 'data.age', 'data.company', 'data.workExperience'], 'submit');
})->with([
    [TestRequiredPropertiesComponentWithDataStatepath::class],
    ['test-component-create-statepath'],
]);