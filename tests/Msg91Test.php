<?php

namespace Anburocky3\PhpMsg91\Tests;

use Anburocky3\PhpMsg91\Msg91;
use PHPUnit\Framework\TestCase;

class Msg91Test extends TestCase
{
    /** @test */
    public function it_can_convert_kg_lbs()
    {
        $lbs = Msg91::fromKilograms(100)->toLbs();

        $this->assertEquals('220.4623', $lbs);
    }
}
