<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum\Tests;

use EquinoxMatt\LaravelNova\Fields\Enum\Enum;
use EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums\AccountType;
use EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums\StatusType;
use Laravel\Nova\Http\Requests\NovaRequest;
use EquinoxMatt\LaravelNova\Fields\Enum\Tests\TestCase;

class FieldTest extends TestCase
{
    private $field;

    protected function setUp(): void
    {
        parent::setUp();

        $this->field = Enum::make('Enum')->attach(StatusType::class);
    }

    /** @test */
    public function it_starts_with_no_options_and_rules()
    {
        $field = Enum::make('Enum');

        $this->assertArrayNotHasKey('options', $field->meta);

        $this->assertEmpty($field->rules);
    }

    /** @test */
    public function it_allows_an_enum_to_be_attached()
    {
        $this->assertArrayHasKey('options', $this->field->meta);
    }

    /** @test */
    public function it_adds_correct_rules()
    {
        $this->assertContains('required', $this->field->rules);
    }

    /** @test */
    public function it_displays_enum_options()
    {
        $this->assertCount(count(StatusType::cases()), $this->field->meta['options']);
        foreach (StatusType::cases() as $enum) {
            $this->assertContains([
                'label' => StatusType::getDescription($enum),
                'value' => $enum->value,
            ], $this->field->meta['options']);
        }
    }

    /** @test */
    public function it_can_be_nullable()
    {
        $this->field->nullable();

        $this->assertNotContains('required', $this->field->rules);
        $this->assertContains('nullable', $this->field->rules);
        $this->assertFalse($this->field->isRequired(new NovaRequest()));
    }
}
