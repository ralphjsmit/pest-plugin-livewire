<?php

namespace RalphJSmit\PestPluginLivewire\Tests\Fixtures;

use Livewire\Component;

class TestRequiredPropertiesComponent extends Component
{
    public string $email_Req = '';
    public string $email = '';
    public ?int $age_Req = null;
    public ?int $age = null;
    public string $name_Req = '';
    public string $name = '';
    public string $company_Req = '';
    public string $company = '';
    public array $workExperience_Req = [];
    public array $workExperience = [];

    protected array $rules = [
        'email' => '',
        'email_Req' => 'required',
        'age' => 'numeric',
        'age_Req' => 'numeric|required',
        'name' => '',
        'name_Req' => 'required',
        'company' => '',
        'company_Req' => 'required',
        'workExperience' => 'array',
        'workExperience_Req' => 'array|required',
    ];

    public function render(): string
    {
        return '<div></div>';
    }

    public function submit()
    {
        $this->validate();
    }
}