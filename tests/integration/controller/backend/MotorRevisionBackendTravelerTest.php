<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Traveler;

class MotorRevisionBackendTravelerTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'travelers',
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

        $this->readPermission   = create_test_permission_with_name('travelers.read');
        $this->writePermission  = create_test_permission_with_name('travelers.write');
        $this->deletePermission = create_test_permission_with_name('travelers.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_traveler()
    {
        $this->visit('/backend/travelers')
            ->see(trans('motor-revision::backend/travelers.travelers'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_traveler()
    {
        $record = create_test_traveler();
        $this->visit('/backend/travelers')
            ->see(trans('motor-revision::backend/travelers.travelers'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_traveler_and_use_the_back_button()
    {
        $record = create_test_traveler();
        $this->visit('/backend/travelers')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/travelers/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/travelers');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_traveler_and_change_values()
    {
        $record = create_test_traveler();

        $this->visit('/backend/travelers/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Traveler', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/travelers.save'));
            })
            ->see(trans('motor-revision::backend/travelers.updated'))
            ->see('Updated Traveler')
            ->seePageIs('/backend/travelers');

        $record = Traveler::find($record->id);
        $this->assertEquals('Updated Traveler', $record->name);
    }

    /** @test */
    public function can_click_the_traveler_create_button()
    {
        $this->visit('/backend/travelers')
            ->click(trans('motor-revision::backend/travelers.new'))
            ->seePageIs('/backend/travelers/create');
    }

    /** @test */
    public function can_create_a_new_traveler()
    {
        $this->visit('/backend/travelers/create')
            ->see(trans('motor-revision::backend/travelers.new'))
            ->type('Create Traveler Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/travelers.save'));
            })
            ->see(trans('motor-revision::backend/travelers.created'))
            ->see('Create Traveler Name')
            ->seePageIs('/backend/travelers');
    }

    /** @test */
    public function cannot_create_a_new_traveler_with_empty_fields()
    {
        $this->visit('/backend/travelers/create')
            ->see(trans('motor-revision::backend/travelers.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/travelers.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/travelers/create');
    }

    /** @test */
    public function can_modify_a_traveler()
    {
        $record = create_test_traveler();
        $this->visit('/backend/travelers/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/travelers.edit'))
            ->type('Modified Traveler Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/travelers.save'));
            })
            ->see(trans('motor-revision::backend/travelers.updated'))
            ->see('Modified Traveler Name')
            ->seePageIs('/backend/travelers');
    }

    /** @test */
    public function can_delete_a_traveler()
    {
        create_test_traveler();

        $this->assertCount(1, Traveler::all());

        $this->visit('/backend/travelers')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/travelers')
            ->see(trans('motor-revision::backend/travelers.deleted'));

        $this->assertCount(0, Traveler::all());
    }

    /** @test */
    public function can_paginate_traveler_results()
    {
        $records = create_test_traveler(100);
        $this->visit('/backend/travelers')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/travelers?page=3');
    }

    /** @test */
    public function can_search_traveler_results()
    {
        $records = create_test_traveler(10);
        $this->visit('/backend/travelers')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
