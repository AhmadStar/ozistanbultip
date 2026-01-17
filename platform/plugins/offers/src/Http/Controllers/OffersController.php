<?php

namespace Botble\Offers\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Offers\Http\Requests\OffersRequest;
use Botble\Offers\Repositories\Interfaces\OffersInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Offers\Tables\OffersTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Offers\Forms\OffersForm;
use Botble\Base\Forms\FormBuilder;

class OffersController extends BaseController
{
    /**
     * @var OffersInterface
     */
    protected $offersRepository;

    /**
     * @param OffersInterface $offersRepository
     */
    public function __construct(OffersInterface $offersRepository)
    {
        $this->offersRepository = $offersRepository;
    }

    /**
     * @param OffersTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(OffersTable $table)
    {
        page_title()->setTitle(trans('plugins/offers::offers.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/offers::offers.create'));

        return $formBuilder->create(OffersForm::class)->renderForm();
    }

    /**
     * @param OffersRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(OffersRequest $request, BaseHttpResponse $response)
    {
        $offers = $this->offersRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(OFFERS_MODULE_SCREEN_NAME, $request, $offers));
        $offers->slug = $this->slug($offers->name, '-');
        $offers->save();
        return $response
            ->setPreviousUrl(route('offers.index'))
            ->setNextUrl(route('offers.edit', $offers->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $offers = $this->offersRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $offers));

        page_title()->setTitle(trans('plugins/offers::offers.edit') . ' "' . $offers->name . '"');

        return $formBuilder->create(OffersForm::class, ['model' => $offers])->renderForm();
    }

    /**
     * @param $id
     * @param OffersRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, OffersRequest $request, BaseHttpResponse $response)
    {
        $offers = $this->offersRepository->findOrFail($id);

        $offers->fill($request->input());

        $this->offersRepository->createOrUpdate($offers);

        event(new UpdatedContentEvent(OFFERS_MODULE_SCREEN_NAME, $request, $offers));
        $offers->slug = $this->slug($offers->name, '-');
        $offers->save();
        return $response
            ->setPreviousUrl(route('offers.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $offers = $this->offersRepository->findOrFail($id);

            $this->offersRepository->delete($offers);

            event(new DeletedContentEvent(OFFERS_MODULE_SCREEN_NAME, $request, $offers));

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
            $offers = $this->offersRepository->findOrFail($id);
            $this->offersRepository->delete($offers);
            event(new DeletedContentEvent(OFFERS_MODULE_SCREEN_NAME, $request, $offers));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }

    public function slug($string, $separator = '-') {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}
