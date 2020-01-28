<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Motor\Revision\Models\Hotel;

class Motor\RevisionBackendHotelTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'hotels',
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

        $this->readPermission   = create_test_permission_with_name('hotels.read');
        $this->writePermission  = create_test_permission_with_name('hotels.write');
        $this->deletePermission = create_test_permission_with_name('hotels.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_hotel()
    {
        $this->visit('/backend/hotels')
            ->see(trans('motor-revision::backend/hotels.hotels'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_hotel()
    {
        $record = create_test_hotel();
        $this->visit('/backend/hotels')
            ->see(trans('motor-revision::backend/hotels.hotels'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_hotel_and_use_the_back_button()
    {
        $record = create_test_hotel();
        $this->visit('/backend/hotels')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/hotels/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/hotels');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_hotel_and_change_values()
    {
        $record = create_test_hotel();

        $this->visit('/backend/hotels/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Hotel', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/hotels.save'));
            })
            ->see(trans('motor-revision::backend/hotels.updated'))
            ->see('Updated Hotel')
            ->seePageIs('/backend/hotels');

        $record = Hotel::find($record->id);
        $this->assertEquals('Updated Hotel', $record->name);
    }

    /** @test */
    public function can_click_the_hotel_create_button()
    {
        $this->visit('/backend/hotels')
            ->click(trans('motor-revision::backend/hotels.new'))
            ->seePageIs('/backend/hotels/create');
    }

    /** @test */
    public function can_create_a_new_hotel()
    {
        $this->visit('/backend/hotels/create')
            ->see(trans('motor-revision::backend/hotels.new'))
            ->type('Create Hotel Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/hotels.save'));
            })
            ->see(trans('motor-revision::backend/hotels.created'))
            ->see('Create Hotel Name')
            ->seePageIs('/backend/hotels');
    }

    /** @test */
    public function cannot_create_a_new_hotel_with_empty_fields()
    {
        $this->visit('/backend/hotels/create')
            ->see(trans('motor-revision::backend/hotels.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/hotels.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/hotels/create');
    }

    /** @test */
    public function can_modify_a_hotel()
    {
        $record = create_test_hotel();
        $this->visit('/backend/hotels/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/hotels.edit'))
            ->type('Modified Hotel Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/hotels.save'));
            })
            ->see(trans('motor-revision::backend/hotels.updated'))
            ->see('Modified Hotel Name')
            ->seePageIs('/backend/hotels');
    }

    /** @test */
    public function can_delete_a_hotel()
    {
        create_test_hotel();

        $this->assertCount(1, Hotel::all());

        $this->visit('/backend/hotels')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/hotels')
            ->see(trans('motor-revision::backend/hotels.deleted'));

        $this->assertCount(0, Hotel::all());
    }

    /** @test */
    public function can_paginate_hotel_results()
    {
        $records = create_test_hotel(100);
        $this->visit('/backend/hotels')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/hotels?page=3');
    }

    /** @test */
    public function can_search_hotel_results()
    {
        $records = create_test_hotel(10);
        $this->visit('/backend/hotels')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
