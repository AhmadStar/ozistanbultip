<?php

namespace Botble\Clinic\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Clinic\Http\Requests\ClinicRequest;
use Botble\Clinic\Repositories\Interfaces\ClinicInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Clinic\Tables\ClinicTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Clinic\Forms\ClinicForm;
use Botble\Base\Forms\FormBuilder;

class ClinicController extends BaseController
{
    /**
     * @var ClinicInterface
     */
    protected $clinicRepository;

    /**
     * @param ClinicInterface $clinicRepository
     */
    public function __construct(ClinicInterface $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
    }

    /**
     * @param ClinicTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ClinicTable $table)
    {
        page_title()->setTitle(trans('plugins/clinic::clinic.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/clinic::clinic.create'));

        return $formBuilder->create(ClinicForm::class)->renderForm();
    }

    /**
     * @param ClinicRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(ClinicRequest $request, BaseHttpResponse $response)
    {
        $clinic = $this->clinicRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CLINIC_MODULE_SCREEN_NAME, $request, $clinic));

        if($request->input('services') != Null)
            $clinic->services()->sync(array_keys($request->input('services')));
        else
            $clinic->services()->detach();

        if($request->input('doctors') != Null)
            $clinic->doctors()->sync(array_keys($request->input('doctors')));
        else
            $clinic->doctors()->detach();

        return $response
            ->setPreviousUrl(route('clinic.index'))
            ->setNextUrl(route('clinic.edit', $clinic->id))
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
        $clinic = $this->clinicRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $clinic));

        page_title()->setTitle(trans('plugins/clinic::clinic.edit') . ' "' . $clinic->name . '"');

        return $formBuilder->create(ClinicForm::class, ['model' => $clinic])->renderForm();
    }

    /**
     * @param int $id
     * @param ClinicRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, ClinicRequest $request, BaseHttpResponse $response)
    {
        $clinic = $this->clinicRepository->findOrFail($id);

        $clinic->fill($request->input());

        $clinic = $this->clinicRepository->createOrUpdate($clinic);

        if($request->input('services') != Null)
            $clinic->services()->sync(array_keys($request->input('services')));
        else
            $clinic->services()->detach();

        if($request->input('doctors') != Null)
            $clinic->doctors()->sync(array_keys($request->input('doctors')));
        else
            $clinic->doctors()->detach();

        event(new UpdatedContentEvent(CLINIC_MODULE_SCREEN_NAME, $request, $clinic));

        return $response
            ->setPreviousUrl(route('clinic.index'))
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
            $clinic = $this->clinicRepository->findOrFail($id);

            $this->clinicRepository->delete($clinic);

            event(new DeletedContentEvent(CLINIC_MODULE_SCREEN_NAME, $request, $clinic));

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
            $clinic = $this->clinicRepository->findOrFail($id);
            $this->clinicRepository->delete($clinic);
            event(new DeletedContentEvent(CLINIC_MODULE_SCREEN_NAME, $request, $clinic));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
