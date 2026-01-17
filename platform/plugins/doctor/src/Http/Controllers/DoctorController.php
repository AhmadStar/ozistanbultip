<?php

namespace Botble\Doctor\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Doctor\Http\Requests\DoctorRequest;
use Botble\Doctor\Repositories\Interfaces\DoctorInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Doctor\Tables\DoctorTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Doctor\Forms\DoctorForm;
use Botble\Base\Forms\FormBuilder;
use Assets;

class DoctorController extends BaseController
{
    /**
     * @var DoctorInterface
     */
    protected $doctorRepository;

    /**
     * @param DoctorInterface $doctorRepository
     */
    public function __construct(DoctorInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * @param DoctorTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DoctorTable $table)
    {
        page_title()->setTitle(trans('plugins/doctor::doctor.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/doctor::doctor.create'));

        return $formBuilder->create(DoctorForm::class)->renderForm();
    }

    public function createForm()
    {
        page_title()->setTitle(trans('plugins/doctor::doctor.create'));

        Assets::addStylesDirectly([
        ])
            ->addScriptsDirectly([
            ]);

        \Assets::addStylesDirectly([
            '/themes/shopwise/vue/backend/jquery.timepicker.css',
        ])
            ->addScriptsDirectly([
                'https://code.jquery.com/jquery-3.5.1.min.js',
                '/themes/shopwise/vue/backend/jquery.timepicker.js',
            ]);


        return view('plugins/doctor::form', [
           'model'=>null,
        ]);
    }

    public function editForm($id, Request $request)
    {
        $doctor = $this->doctorRepository->findOrFail($id);
        // $locations = Location::Getlocations();

        \Assets::addStylesDirectly([
        ])
            ->addScriptsDirectly([
            ]);

        \Assets::addStylesDirectly([
            '/themes/shopwise/vue/backend/jquery.timepicker.css',
        ])
            ->addScriptsDirectly([
                'https://code.jquery.com/jquery-3.5.1.min.js',
                '/themes/shopwise/vue/backend/jquery.timepicker.js',
            ]);

        page_title()->setTitle(trans('plugins/doctor::doctor.edit'));

        return view('plugins/doctor::form', [
           'model' => $doctor,
        ]);
    }

    /**
     * @param DoctorRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(DoctorRequest $request, BaseHttpResponse $response)
    {
        $doctor = $this->doctorRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(DOCTOR_MODULE_SCREEN_NAME, $request, $doctor));

        return $response
            ->setPreviousUrl(route('doctor.index'))
            ->setNextUrl(route('doctor.edit', $doctor->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $doctor = $this->doctorRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $doctor));

        page_title()->setTitle(trans('plugins/doctor::doctor.edit') . ' "' . $doctor->name . '"');

        return $formBuilder->create(DoctorForm::class, ['model' => $doctor])->renderForm();
    }

    /**
     * @param int $id
     * @param DoctorRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, DoctorRequest $request, BaseHttpResponse $response)
    {
        $doctor = $this->doctorRepository->findOrFail($id);

        $request->merge(['saturday_status' => $request->input('saturday_status') ? 1 : 0]);
        $request->merge(['sunday_status' => $request->input('sunday_status') ? 1 : 0]);
        $request->merge(['monday_status' => $request->input('monday_status') ? 1 : 0]);
        $request->merge(['tuesday_status' => $request->input('tuesday_status') ? 1 : 0]);
        $request->merge(['wednesday_status' => $request->input('wednesday_status') ? 1 : 0]);
        $request->merge(['thursday_status' => $request->input('thursday_status') ? 1 : 0]);
        $request->merge(['friday_status' => $request->input('friday_status') ? 1 : 0]);
        $request->merge(['message' => $request->input('message')]);

        $doctor->fill($request->input());

        $doctor = $this->doctorRepository->createOrUpdate($doctor);

        event(new UpdatedContentEvent(DOCTOR_MODULE_SCREEN_NAME, $request, $doctor));

        return $response
            ->setPreviousUrl(route('doctor.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $doctor = $this->doctorRepository->findOrFail($id);

            $this->doctorRepository->delete($doctor);

            event(new DeletedContentEvent(DOCTOR_MODULE_SCREEN_NAME, $request, $doctor));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $doctor = $this->doctorRepository->findOrFail($id);
            $this->doctorRepository->delete($doctor);
            event(new DeletedContentEvent(DOCTOR_MODULE_SCREEN_NAME, $request, $doctor));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
