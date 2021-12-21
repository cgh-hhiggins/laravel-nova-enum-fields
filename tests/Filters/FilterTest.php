<?php

namespace EquinoxMatt\LaravelNova\Fields\Enum\Tests\Filters;

use EquinoxMatt\LaravelNova\Fields\Enum\EnumFilter;
use EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums\AccountType;
use EquinoxMatt\LaravelNova\Fields\Enum\Tests\TestCase;
use JoshGaber\NovaUnit\Filters\MockFilter;

class FilterTest extends TestCase
{
    private $filter;

    private $mockFilter;

    protected function setUp(): void
    {
        $this->filter = new EnumFilter('enum', AccountType::class);

        $this->mockFilter = new MockFilter($this->filter);
    }

    /** @test */
    public function it_is_a_select_filter()
    {
        $this->mockFilter->assertSelectFilter();
    }

    /** @test */
    public function it_has_a_default_name()
    {
        $this->assertEquals('Enum', $this->filter->name());
    }

    /** @test */
    public function it_can_have_a_different_name()
    {
        $this->filter->name('Different name');

        $this->assertEquals('Different name', $this->filter->name());
    }

    /** @test */
    public function it_accepts_an_optional_default_value()
    {
        $this->filter->default(AccountType::FREE);

        $this->assertEquals(AccountType::FREE->value, $this->filter->jsonSerialize()['currentValue']);

        $this->filter->default(AccountType::PREMIUM);

        $this->assertEquals(AccountType::PREMIUM->value, $this->filter->jsonSerialize()['currentValue']);
    }

    /** @test */
    public function it_has_no_default_value_by_default()
    {
        $this->assertEquals('', $this->filter->jsonSerialize()['currentValue']);
    }
}