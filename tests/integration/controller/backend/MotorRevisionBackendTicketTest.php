<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \Motor\Revision\Models\Ticket;

class Motor\RevisionBackendTicketTest extends TestCase
{

    use DatabaseTransactions;

    protected $user;

    protected $readPermission;

    protected $writePermission;

    protected $deletePermission;

    protected $tables = [
        'tickets',
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

        $this->readPermission   = create_test_permission_with_name('tickets.read');
        $this->writePermission  = create_test_permission_with_name('tickets.write');
        $this->deletePermission = create_test_permission_with_name('tickets.delete');

        $this->actingAs($this->user);
    }


    /** @test */
    public function can_see_grid_without_ticket()
    {
        $this->visit('/backend/tickets')
            ->see(trans('motor-revision::backend/tickets.tickets'))
            ->see(trans('motor-backend::backend/global.no_records'));
    }

    /** @test */
    public function can_see_grid_with_one_ticket()
    {
        $record = create_test_ticket();
        $this->visit('/backend/tickets')
            ->see(trans('motor-revision::backend/tickets.tickets'))
            ->see($record->name);
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_ticket_and_use_the_back_button()
    {
        $record = create_test_ticket();
        $this->visit('/backend/tickets')
            ->within('table', function(){
                $this->click(trans('motor-backend::backend/global.edit'));
            })
            ->seePageIs('/backend/tickets/'.$record->id.'/edit')
            ->click(trans('motor-backend::backend/global.back'))
            ->seePageIs('/backend/tickets');
    }

    /** @test */
    public function can_visit_the_edit_form_of_a_ticket_and_change_values()
    {
        $record = create_test_ticket();

        $this->visit('/backend/tickets/'.$record->id.'/edit')
            ->see($record->name)
            ->type('Updated Ticket', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/tickets.save'));
            })
            ->see(trans('motor-revision::backend/tickets.updated'))
            ->see('Updated Ticket')
            ->seePageIs('/backend/tickets');

        $record = Ticket::find($record->id);
        $this->assertEquals('Updated Ticket', $record->name);
    }

    /** @test */
    public function can_click_the_ticket_create_button()
    {
        $this->visit('/backend/tickets')
            ->click(trans('motor-revision::backend/tickets.new'))
            ->seePageIs('/backend/tickets/create');
    }

    /** @test */
    public function can_create_a_new_ticket()
    {
        $this->visit('/backend/tickets/create')
            ->see(trans('motor-revision::backend/tickets.new'))
            ->type('Create Ticket Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/tickets.save'));
            })
            ->see(trans('motor-revision::backend/tickets.created'))
            ->see('Create Ticket Name')
            ->seePageIs('/backend/tickets');
    }

    /** @test */
    public function cannot_create_a_new_ticket_with_empty_fields()
    {
        $this->visit('/backend/tickets/create')
            ->see(trans('motor-revision::backend/tickets.new'))
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/tickets.save'));
            })
            ->see('Data missing!')
            ->seePageIs('/backend/tickets/create');
    }

    /** @test */
    public function can_modify_a_ticket()
    {
        $record = create_test_ticket();
        $this->visit('/backend/tickets/'.$record->id.'/edit')
            ->see(trans('motor-revision::backend/tickets.edit'))
            ->type('Modified Ticket Name', 'name')
            ->within('.box-footer', function(){
                $this->press(trans('motor-revision::backend/tickets.save'));
            })
            ->see(trans('motor-revision::backend/tickets.updated'))
            ->see('Modified Ticket Name')
            ->seePageIs('/backend/tickets');
    }

    /** @test */
    public function can_delete_a_ticket()
    {
        create_test_ticket();

        $this->assertCount(1, Ticket::all());

        $this->visit('/backend/tickets')
            ->within('table', function(){
                $this->press(trans('motor-backend::backend/global.delete'));
            })
            ->seePageIs('/backend/tickets')
            ->see(trans('motor-revision::backend/tickets.deleted'));

        $this->assertCount(0, Ticket::all());
    }

    /** @test */
    public function can_paginate_ticket_results()
    {
        $records = create_test_ticket(100);
        $this->visit('/backend/tickets')
            ->within('.pagination', function(){
                $this->click('3');
            })
            ->seePageIs('/backend/tickets?page=3');
    }

    /** @test */
    public function can_search_ticket_results()
    {
        $records = create_test_ticket(10);
        $this->visit('/backend/tickets')
            ->type(substr($records[6]->name, 0, 3), 'search')
            ->press('grid-search-button')
            ->seeInField('search', substr($records[6]->name, 0, 3))
            ->see($records[6]->name);
    }
}
