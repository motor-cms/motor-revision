<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Ride;

class MotorRevisionBackendRideTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'rides',
        'users',
        'languages',
        'clients',
        'permissions',
        'roles',
        'model_has_permissions',
        'model_has_roles',
        'role_has_permissions',
        'media'
    ];


    public function setUp()
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/../../../../database/factories');

        $this->addDefaults();
    }


    protected function addDefaults()
    {
        $this->user   = create_test_superadmin();

        $this->readPermission   = create_test_permission_with_name('rides.read');
        $this->writePermission  = create_test_permission_with_name('rides.write');
        $this->deletePermission = create_test_permission_with_name('rides.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_ride()
    {
        $this->visit('/backend/rides')
            ->see(trans('motor-revision::backend/rides.rides'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_ride()
    {
        $record = create_test_ride();
        $this->visit('/backend/rides')
            ->see(trans('motor-revision::backend/rides.rides'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_ride_and_use_the_back_button()
    {
        $record = create_test_ride();
        $this->visit('/backend/rides')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/rides/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/rides');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_ride_and_change_values()
    {
        $record = create_test_ride();

        $this->visit('/backend/rides/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Ride', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/rides.save'));
            })
            ->see(trans('motor-revision::backend/rides.updated'))
            ->see('Updated Ride')
            ->seePageIs('/backend/rides');

        $record = Ride::find($record->id);
        $this->assertEquals('Updated Ride', $record->name);
    }

    /** @test */
    public function can_click_the_ride_create_button()
    {
        $this->visit('/backend/rides')
            ->click(trans('motor-revision::backend/rides.new'))
            ->seePageIs('/backend/rides/create');
    }

    /** @test */
    public function can_create_a_new_ride()
    {
        $this->visit('/backend/rides/create')
            ->see(trans('motor-revision::backend/rides.new'))
            ->type('Create Ride Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/rides.save'));
            })
            ->see(trans('motor-revision::backend/rides.created'))
            ->see('Create Ride Name')
            ->seePageIs('/backend/rides');
    }

    /** @test */
    public function cannot_create_a_new_ride_with_empty_fields()
    {
        $this->visit('/backend/rides/create')
            ->see(trans('motor-revision::backend/rides.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/rides.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/rides/create');
    }

    /** @test */
    public function can_modify_a_ride()
    {
        $record = create_test_ride();
        $this->visit('/backend/rides/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/rides.edit'))
            ->type('Modified Ride Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/rides.save'));
            })
            ->see(trans('motor-revision::backend/rides.updated'))
            ->see('Modified Ride Name')
            ->seePageIs('/backend/rides');
    }

    /** @test */
    public function can_delete_a_ride()
    {
        create_test_ride();

        $this->assertCount(1, Ride::all());

        $this->visit('/backend/rides')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/rides')
            ->see(trans('motor-revision::backend/rides.deleted'));

        $this->assertCount(0, Ride::all());
    }

    /** @test */
    public function can_paginate_ride_results()
    {
        $records = create_test_ride(100);
        $this->visit('/backend/rides')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/rides?page=3');
    }

    /** @test */
    public function can_search_ride_results()
    {
        $records = create_test_ride(10);
        $this->visit('/backend/rides')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
