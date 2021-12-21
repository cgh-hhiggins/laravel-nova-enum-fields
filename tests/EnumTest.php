<?php

use EquinoxMatt\LaravelNova\Fields\Enum\Tests\Enums\AccountType;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function test_get_enum_as_select_array()
    {
        $expected = [
            0 => 'Free Tier',
            1 => 'Standard Tier',
            2 => 'Premium Tier',
        ];

        $this->assertEquals($expected, AccountType::getAsSelectArray());
    }

    public function test_get_enum_descriptions()
    {
        $this->assertEquals('Free Tier', AccountType::getDescription(AccountType::FREE));
        $this->assertEquals('Standard Tier', AccountType::getDescription(AccountType::STANDARD));
        $this->assertEquals('Premium Tier', AccountType::getDescription(AccountType::PREMIUM));
    }
}