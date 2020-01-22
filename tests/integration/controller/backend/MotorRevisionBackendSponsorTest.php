<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Sponsor;

class MotorRevisionBackendSponsorTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'sponsors',
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

        $this->readPermission   = create_test_permission_with_name('sponsors.read');
        $this->writePermission  = create_test_permission_with_name('sponsors.write');
        $this->deletePermission = create_test_permission_with_name('sponsors.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_sponsor()
    {
        $this->visit('/backend/sponsors')
            ->see(trans('motor\revision::backend/sponsors.sponsors'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_sponsor()
    {
        $record = create_test_sponsor();
        $this->visit('/backend/sponsors')
            ->see(trans('motor\revision::backend/sponsors.sponsors'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_sponsor_and_use_the_back_button()
    {
        $record = create_test_sponsor();
        $this->visit('/backend/sponsors')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/sponsors/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/sponsors');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_sponsor_and_change_values()
    {
        $record = create_test_sponsor();

        $this->visit('/backend/sponsors/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Sponsor', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor\revision::backend/sponsors.save'));
            })
            ->see(trans('motor\revision::backend/sponsors.updated'))
            ->see('Updated Sponsor')
            ->seePageIs('/backend/sponsors');

        $record = Sponsor::find($record->id);
        $this->assertEquals('Updated Sponsor', $record->name);
    }

    /** @test */
    public function can_click_the_sponsor_create_button()
    {
        $this->visit('/backend/sponsors')
            ->click(trans('motor\revision::backend/sponsors.new'))
            ->seePageIs('/backend/sponsors/create');
    }

    /** @test */
    public function can_create_a_new_sponsor()
    {
        $this->visit('/backend/sponsors/create')
            ->see(trans('motor\revision::backend/sponsors.new'))
            ->type('Create Sponsor Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor\revision::backend/sponsors.save'));
            })
            ->see(trans('motor\revision::backend/sponsors.created'))
            ->see('Create Sponsor Name')
            ->seePageIs('/backend/sponsors');
    }

    /** @test */
    public function cannot_create_a_new_sponsor_with_empty_fields()
    {
        $this->visit('/backend/sponsors/create')
            ->see(trans('motor\revision::backend/sponsors.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor\revision::backend/sponsors.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/sponsors/create');
    }

    /** @test */
    public function can_modify_a_sponsor()
    {
        $record = create_test_sponsor();
        $this->visit('/backend/sponsors/'.$record->id.'/edit')
            ->see(trans('motor\revision::backend/sponsors.edit'))
            ->type('Modified Sponsor Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor\revision::backend/sponsors.save'));
            })
            ->see(trans('motor\revision::backend/sponsors.updated'))
            ->see('Modified Sponsor Name')
            ->seePageIs('/backend/sponsors');
    }

    /** @test */
    public function can_delete_a_sponsor()
    {
        create_test_sponsor();

        $this->assertCount(1, Sponsor::all());

        $this->visit('/backend/sponsors')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/sponsors')
            ->see(trans('motor\revision::backend/sponsors.deleted'));

        $this->assertCount(0, Sponsor::all());
    }

    /** @test */
    public function can_paginate_sponsor_results()
    {
        $records = create_test_sponsor(100);
        $this->visit('/backend/sponsors')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/sponsors?page=3');
    }

    /** @test */
    public function can_search_sponsor_results()
    {
        $records = create_test_sponsor(10);
        $this->visit('/backend/sponsors')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
