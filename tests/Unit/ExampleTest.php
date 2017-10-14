<?php

namespace Tests\Unit;

use App\Model\Room;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

//    public function test数据库连接()
//    {
//        $expect = 0;
//        $actual = Room::all();
//
//        $this->assertCount($expect, $actual);
//    }
}
