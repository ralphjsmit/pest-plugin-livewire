<?php

namespace RalphJSmit\PestPluginLivewire\Tests\Fixtures;

use Livewire\Component;

class TestRequiredPropertiesComponentWithDataStatepath extends Component
{
    public array $data = [];

    protected array $rules = [
        'data.email' => '',
        'data.email_Req' => 'required',
        'data.age' => 'numeric',
        'data.age_Req' => 'numeric|required',
        'data.name' => '',
        'data.name_Req' => 'required',
        'data.company' => '',
        'data.company_Req' => 'required',
        'data.workExperience' => 'array',
        'data.workExperience_Req' => 'array|required',
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
