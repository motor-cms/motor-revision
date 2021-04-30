<?php

namespace Motor\Revision\Components;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Helpers\EmailHelper;
use Motor\CMS\Models\PageVersionComponent;
use Motor\Revision\Forms\Component\Ticket\AtHomeForm;
use Motor\Revision\Forms\Component\Ticket\SubsidizedForm;
use Motor\Revision\Forms\Component\Ticket\SupporterForm;
use Motor\Revision\Services\TicketService;

class ComponentTickets
{
    use FormBuilderTrait;

    protected $component;

    protected $pageVersionComponent;

    /**
     * @var
     */
    protected $ticketForm;

    /**
     * @var
     */
    protected $record;

    /**
     * @var
     */
    protected $request;

    public function __construct(
        PageVersionComponent $pageVersionComponent,
        \Motor\Revision\Models\Component\ComponentTicket $component
    ) {
        $this->component = $component;
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        $this->request = $request;

        $formOptions = [
            'name'    => 'ticket-'.$this->component->type,
            'url'     => $this->request->url(),
            'method'  => 'POST',
            'enctype' => 'multipart/form-data',
        ];

        switch ($this->component->type) {
            case 'at_home':
                $this->ticketForm = $this->form(AtHomeForm::class, $formOptions);
                break;
            case 'supporter':
                $this->ticketForm = $this->form(SupporterForm::class, $formOptions);
                break;
            case 'subsidized':
                $this->ticketForm = $this->form(SubsidizedForm::class, $formOptions);
                break;
        }

        if ($request->method() === 'POST') {
            $result = $this->post();
            if ($result instanceof RedirectResponse) {
                return $result;
            }
        }

        return $this->render();
    }

    /**
     * @return RedirectResponse|Redirector
     */
    protected function post()
    {
        if (! $this->ticketForm->isValid()) {
            return redirect()
                ->back()
                ->withErrors($this->ticketForm->getErrors())
                ->withInput();
        }

        $record = TicketService::createWithForm($this->request, $this->ticketForm)
                               ->getResult();

        // Send emails
        EmailHelper::sendEmail($record->type.'_ticket_info', [], ['ticket' => $record]);
        EmailHelper::sendEmail($record->type.'_ticket_registration', [
            'to_email' => $record->email,
            'to_name'  => $record->name,
        ], ['ticket' => $record]);

        // Create flash alert and hide form
        flash()->success(trans('motor-revision::component/tickets.'.$record->type.'_successful'));

        return redirect()->back();
    }

    public function render()
    {
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), [
                'ticketForm' => $this->ticketForm,
                'record'     => $this->record,
                'component'  => $this->component,
            ]);
    }
}
