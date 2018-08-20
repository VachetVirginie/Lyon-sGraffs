<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,DatabaseMigrations,DatabaseTransactions,RefreshDatabase, Init {
		Init::refreshInMemoryDatabase insteadof RefreshDatabase;
    }
   
    protected $faker;
    /**
     * Set up the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
 
    }
    /**
     * Reset the migrations
     */
    public function tearDown()
    {
        //$this->artisan('migrate:reset');
        parent::tearDown();
    }

	/**
     * Authentification.
     *
     * @return void
     */
    protected function auth($id) 
    {
    	$user = User::find($id);

        $this->actingAs($user);
    }
}
