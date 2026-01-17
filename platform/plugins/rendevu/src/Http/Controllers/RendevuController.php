<?php

namespace Botble\Rendevu\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Rendevu\Http\Requests\RendevuRequest;
use Botble\Rendevu\Repositories\Interfaces\RendevuInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Rendevu\Tables\RendevuTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Rendevu\Forms\RendevuForm;
use Botble\Base\Forms\FormBuilder;
use Botble\Rendevu\Models\Rendevu;
use Botble\Rendevu\Models\RendevuBackup;

class RendevuController extends BaseController
{
    /**
     * @var RendevuInterface
     */
    protected $rendevuRepository;

    /**
     * @param RendevuInterface $rendevuRepository
     */
    public function __construct(RendevuInterface $rendevuRepository)
    {
        $this->rendevuRepository = $rendevuRepository;
    }

    /**
     * @param RendevuTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RendevuTable $table)
    {
        page_title()->setTitle(trans('plugins/rendevu::rendevu.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/rendevu::rendevu.create'));

        return $formBuilder->create(RendevuForm::class)->renderForm();
    }

    /**
     * @param RendevuRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(RendevuRequest $request, BaseHttpResponse $response)
    {
        $rendevu = $this->rendevuRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(RENDEVU_MODULE_SCREEN_NAME, $request, $rendevu));

        return $response
            ->setPreviousUrl(route('rendevu.index'))
            ->setNextUrl(route('rendevu.edit', $rendevu->id))
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
        $rendevu = $this->rendevuRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $rendevu));

        page_title()->setTitle(trans('plugins/rendevu::rendevu.edit') . ' "' . $rendevu->name . '"');

        return $formBuilder->create(RendevuForm::class, ['model' => $rendevu])->renderForm();
    }

    /**
     * @param int $id
     * @param RendevuRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, RendevuRequest $request, BaseHttpResponse $response)
    {
        $rendevu = $this->rendevuRepository->findOrFail($id);

        $rendevu->fill($request->input());

        $rendevu = $this->rendevuRepository->createOrUpdate($rendevu);

        event(new UpdatedContentEvent(RENDEVU_MODULE_SCREEN_NAME, $request, $rendevu));

        return $response
            ->setPreviousUrl(route('rendevu.index'))
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
            $rendevu = $this->rendevuRepository->findOrFail($id);

            $this->rendevuRepository->delete($rendevu);
            $this->backup($rendevu);

            event(new DeletedContentEvent(RENDEVU_MODULE_SCREEN_NAME, $request, $rendevu));

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
            $rendevu = $this->rendevuRepository->findOrFail($id);
            $this->rendevuRepository->delete($rendevu);
            $this->backup($rendevu);
            event(new DeletedContentEvent(RENDEVU_MODULE_SCREEN_NAME, $request, $rendevu));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }


    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function backup(Rendevu $rendvu)
    {
        $user  = new RendevuBackup([
            'name' => $rendvu->name,
            'phone' => $rendvu->phone,
            'doctor_id' => $rendvu->doctor_id,
            'clinic_id' => $rendvu->clinic_id,
            'service_id' => $rendvu->service_id,
            'date' => $rendvu->date,
            'day' => $rendvu->day,
            'time' => $rendvu->time,
            'created_at' => $rendvu->created_at,
            'updated_at' => $rendvu->updated_at,
        ]);

        $user->save();

    }
}
