<?php

namespace RalphJSmit\PestPluginLivewire;

use Illuminate\Support\Collection;
use Livewire\Testing\TestableLivewire;
use ReflectionProperty;

if ( ! function_exists('validInput') ) {
    function validInput(array $input): Collection
    {
        return collect($input);
    }
}

if ( ! function_exists('assertRequiredProperties') ) {
    function assertRequiredProperties(
        TestableLivewire $livewire,
        Collection $validInput,
        array $requiredProperties,
        string $submitFunction
    ): void {
        foreach ($requiredProperties as $requiredProperty) {
            $reflection = ( new ReflectionProperty($livewire->instance(), $requiredProperty) )->getType();

            $allowedDefaultValue = $reflection->allowsNull()
                ? null
                : match ( $reflection->getName() ) {
                    'string' => '',
                    'int' => 0,
                    'array' => [],
                };

            $livewire
                ->set($validInput->put(key: $requiredProperty, value: $allowedDefaultValue,)->toArray())
                ->call($submitFunction)
                ->assertHasErrors([$requiredProperty => ['required']]);
        }
    }
}
if ( ! function_exists('assertNotRequiredProperties') ) {
    function assertNotRequiredProperties(
        TestableLivewire $livewire,
        Collection $validInput,
        array $notRequiredProperties,
        string $submitFunction
    ): void {
        foreach ($notRequiredProperties as $notRequiredProperty) {
            $reflection = ( new ReflectionProperty($livewire->instance(), $notRequiredProperty) )->getType();

            $allowedDefaultValue = $reflection->allowsNull()
                ? null
                : match ( $reflection->getName() ) {
                    'string' => '',
                    'int' => 0,
                    'array' => [],
                };

            $livewire
                ->set($validInput->put(key: $notRequiredProperty, value: $allowedDefaultValue,)->toArray())
                ->call($submitFunction)
                ->assertHasNoErrors([$notRequiredProperty => ['required']]);
        }
    }
}