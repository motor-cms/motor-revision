<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Shuttle;

class MotorRevisionBackendShuttleTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'shuttles',
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

        $this->readPermission   = create_test_permission_with_name('shuttles.read');
        $this->writePermission  = create_test_permission_with_name('shuttles.write');
        $this->deletePermission = create_test_permission_with_name('shuttles.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_shuttle()
    {
        $this->visit('/backend/shuttles')
            ->see(trans('motor-revision::backend/shuttles.shuttles'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_shuttle()
    {
        $record = create_test_shuttle();
        $this->visit('/backend/shuttles')
            ->see(trans('motor-revision::backend/shuttles.shuttles'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_shuttle_and_use_the_back_button()
    {
        $record = create_test_shuttle();
        $this->visit('/backend/shuttles')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/shuttles/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/shuttles');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_shuttle_and_change_values()
    {
        $record = create_test_shuttle();

        $this->visit('/backend/shuttles/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Shuttle', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/shuttles.save'));
            })
            ->see(trans('motor-revision::backend/shuttles.updated'))
            ->see('Updated Shuttle')
            ->seePageIs('/backend/shuttles');

        $record = Shuttle::find($record->id);
        $this->assertEquals('Updated Shuttle', $record->name);
    }

    /** @test */
    public function can_click_the_shuttle_create_button()
    {
        $this->visit('/backend/shuttles')
            ->click(trans('motor-revision::backend/shuttles.new'))
            ->seePageIs('/backend/shuttles/create');
    }

    /** @test */
    public function can_create_a_new_shuttle()
    {
        $this->visit('/backend/shuttles/create')
            ->see(trans('motor-revision::backend/shuttles.new'))
            ->type('Create Shuttle Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/shuttles.save'));
            })
            ->see(trans('motor-revision::backend/shuttles.created'))
            ->see('Create Shuttle Name')
            ->seePageIs('/backend/shuttles');
    }

    /** @test */
    public function cannot_create_a_new_shuttle_with_empty_fields()
    {
        $this->visit('/backend/shuttles/create')
            ->see(trans('motor-revision::backend/shuttles.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/shuttles.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/shuttles/create');
    }

    /** @test */
    public function can_modify_a_shuttle()
    {
        $record = create_test_shuttle();
        $this->visit('/backend/shuttles/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/shuttles.edit'))
            ->type('Modified Shuttle Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/shuttles.save'));
            })
            ->see(trans('motor-revision::backend/shuttles.updated'))
            ->see('Modified Shuttle Name')
            ->seePageIs('/backend/shuttles');
    }

    /** @test */
    public function can_delete_a_shuttle()
    {
        create_test_shuttle();

        $this->assertCount(1, Shuttle::all());

        $this->visit('/backend/shuttles')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/shuttles')
            ->see(trans('motor-revision::backend/shuttles.deleted'));

        $this->assertCount(0, Shuttle::all());
    }

    /** @test */
    public function can_paginate_shuttle_results()
    {
        $records = create_test_shuttle(100);
        $this->visit('/backend/shuttles')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/shuttles?page=3');
    }

    /** @test */
    public function can_search_shuttle_results()
    {
        $records = create_test_shuttle(10);
        $this->visit('/backend/shuttles')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
