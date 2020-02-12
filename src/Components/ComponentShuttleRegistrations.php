<?php

namespace Motor\Revision\Components;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\Backend\Helpers\EmailHelper;
use Motor\CMS\Models\PageVersionComponent;
use Motor\Revision\Forms\Component\ShuttleRegistrationForm;
use Motor\Revision\Models\Traveler;

class ComponentShuttleRegistrations
{

    use FormBuilderTrait;

    protected $pageVersionComponent;

    /**
     * @var
     */
    protected $shuttleForm;

    /**
     * @var
     */
    protected $record;

    /**
     * @var
     */
    protected $request;

    public function __construct(PageVersionComponent $pageVersionComponent)
    {
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        $this->request = $request;

        $formOptions = [
//            'name'    => '',
            'url'     => $this->request->url(),
            'method'  => 'POST',
            'enctype' => 'multipart/form-data',
        ];

        $this->shuttleForm = $this->form(ShuttleRegistrationForm::class, $formOptions);

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
        if (! $this->shuttleForm->isValid()) {
            return redirect()->back()->withErrors($this->shuttleForm->getErrors())->withInput();
        }

        $arrivalTraveler = false;
        if ($this->request->get('arrival_flight_number') !== '') {
            $arrivalTraveler = new Traveler();
            $arrivalTraveler->name = $this->request->get('name');
            $arrivalTraveler->mobile_phone = $this->request->get('mobile_phone');
            $arrivalTraveler->email = $this->request->get('email');
            $arrivalTraveler->direction = 'party';
            $arrivalTraveler->airport_id = $this->request->get('arrival_airport_id');
            $arrivalTraveler->number_of_people = $this->request->get('arrival_number_of_people');
            $arrivalTraveler->flight_time = $this->request->get('arrival_flight_time');
            $arrivalTraveler->flight_number = $this->request->get('arrival_flight_number');
            $arrivalTraveler->save();
        }

        $departureTraveler = false;
        if ($this->request->get('departure_flight_number') !== '') {
            $departureTraveler = new Traveler();
            $departureTraveler->name = $this->request->get('name');
            $departureTraveler->mobile_phone = $this->request->get('mobile_phone');
            $departureTraveler->email = $this->request->get('email');
            $departureTraveler->direction = 'airport';
            $departureTraveler->airport_id = $this->request->get('departure_airport_id');
            $departureTraveler->number_of_people = $this->request->get('departure_number_of_people');
            $departureTraveler->flight_time = $this->request->get('departure_flight_time');
            $departureTraveler->flight_number = $this->request->get('departure_flight_number');
            $departureTraveler->save();
        }

        // Send emails
        EmailHelper::sendEmail('shuttle_registration', ['to_email' => $this->request->get('email'), 'to_name' => $this->request->get('name')], [ 'name' => $this->request->get('name'), 'arrival' => $arrivalTraveler, 'departure' => $departureTraveler ]);

        // Create flash alert and hide form
        flash()->success(trans('motor-revision::component/shuttle-registrations.registration_successful'));

        return redirect()->back();
    }

    public function render()
    {
        return view(
            config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'),
            [
                'shuttleForm' => $this->shuttleForm,
            ]
        );
    }

}
