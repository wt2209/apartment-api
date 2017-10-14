<?php

namespace Tests\Unit\Repositories;

use App;
use App\Model\Person;
use App\Model\Room;
use App\Repositories\PersonRepository;
use Tests\TestCase;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonRepositoryTest extends TestCase
{
//    use DatabaseMigrations;

    private $initStatus = false;
    // initialize the database by artisan
    public function init()
    {
        if ($this->initStatus) {
            return;
        }
        $this->initStatus = true;
        // the artisan command is like 'php artisan migrate --seed'
        $this->artisan('migrate', ['--seed'=>'default']);

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_people_by_selection()
    {
        $this->init();
        $inputs = [
            'search'=>'select',
            'type'=>1, //college
            'building'=>'7',
            'unit'=>'1'
        ];
        $target = App::make(PersonRepository::class);
        $expect = ['roomCount'=>12, 'peopleCount'=>36];
        $actual = $target->getPeople($inputs);
        $this->assertArraySubset($expect, $actual);
    }

    public function test_get_people_by_room_keyword()
    {
        $this->init();
        $inputs = [
            'search'=>'keyword',
            'keyword'=>'7-1-201'
        ];
        $target = App::make(PersonRepository::class);
        $expect = ['roomCount'=>1, 'peopleCount'=>3];
        $actual = $target->getPeople($inputs);
        $this->assertArraySubset($expect, $actual);
    }
}
