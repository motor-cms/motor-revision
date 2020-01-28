<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Airport;

class Motor\RevisionBackendAirportTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'airports',
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

        $this->readPermission   = create_test_permission_with_name('airports.read');
        $this->writePermission  = create_test_permission_with_name('airports.write');
        $this->deletePermission = create_test_permission_with_name('airports.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_airport()
    {
        $this->visit('/backend/airports')
            ->see(trans('motor-revision::backend/airports.airports'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_airport()
    {
        $record = create_test_airport();
        $this->visit('/backend/airports')
            ->see(trans('motor-revision::backend/airports.airports'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_airport_and_use_the_back_button()
    {
        $record = create_test_airport();
        $this->visit('/backend/airports')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/airports/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/airports');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_airport_and_change_values()
    {
        $record = create_test_airport();

        $this->visit('/backend/airports/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Airport', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/airports.save'));
            })
            ->see(trans('motor-revision::backend/airports.updated'))
            ->see('Updated Airport')
            ->seePageIs('/backend/airports');

        $record = Airport::find($record->id);
        $this->assertEquals('Updated Airport', $record->name);
    }

    /** @test */
    public function can_click_the_airport_create_button()
    {
        $this->visit('/backend/airports')
            ->click(trans('motor-revision::backend/airports.new'))
            ->seePageIs('/backend/airports/create');
    }

    /** @test */
    public function can_create_a_new_airport()
    {
        $this->visit('/backend/airports/create')
            ->see(trans('motor-revision::backend/airports.new'))
            ->type('Create Airport Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/airports.save'));
            })
            ->see(trans('motor-revision::backend/airports.created'))
            ->see('Create Airport Name')
            ->seePageIs('/backend/airports');
    }

    /** @test */
    public function cannot_create_a_new_airport_with_empty_fields()
    {
        $this->visit('/backend/airports/create')
            ->see(trans('motor-revision::backend/airports.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/airports.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/airports/create');
    }

    /** @test */
    public function can_modify_a_airport()
    {
        $record = create_test_airport();
        $this->visit('/backend/airports/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/airports.edit'))
            ->type('Modified Airport Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/airports.save'));
            })
            ->see(trans('motor-revision::backend/airports.updated'))
            ->see('Modified Airport Name')
            ->seePageIs('/backend/airports');
    }

    /** @test */
    public function can_delete_a_airport()
    {
        create_test_airport();

        $this->assertCount(1, Airport::all());

        $this->visit('/backend/airports')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/airports')
            ->see(trans('motor-revision::backend/airports.deleted'));

        $this->assertCount(0, Airport::all());
    }

    /** @test */
    public function can_paginate_airport_results()
    {
        $records = create_test_airport(100);
        $this->visit('/backend/airports')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/airports?page=3');
    }

    /** @test */
    public function can_search_airport_results()
    {
        $records = create_test_airport(10);
        $this->visit('/backend/airports')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
