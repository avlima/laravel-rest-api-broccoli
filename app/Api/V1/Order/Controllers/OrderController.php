<?php

namespace  App\Api\V1\Order\Controllers;

use App\Api\V1\Order\Contracts\OrderRepositoryInterface;
use App\Api\V1\Order\Providers\OrderServiceProvider;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Utils\HttpResponseUtils;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use HttpResponseUtils;

    /**
     * @var OrderServiceProvider
     */
    private $order_repository;

    /**
     * OrderController constructor.
     *
     * @param OrderRepositoryInterface $order_repository
     */
    public function __construct(OrderRepositoryInterface $order_repository)
    {
        $this->order_repository = $order_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $orders = $this->order_repository->getAll($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $orders = self::httpResponse($orders, $this->response_type);
        }

        return response($orders, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$this->response_type}");
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id, Request $request)
    {
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $order = $this->order_repository->getById($id)->toArray();

        if ($this->response_type !== 'json') {
            $order = self::httpResponse($order, $this->response_type);
        }

        return response($order, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$this->response_type}");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $order = $this->order_repository->create($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $order = self::httpResponse($order, $this->response_type);
        }

        return response($order, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$this->response_type}");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(string $id, Request $request)
    {
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $order = $this->order_repository->update($request->all(), $id)->toArray();

        if ($this->response_type !== 'json') {
            $order = self::httpResponse($order, $this->response_type);
        }

        return response($order, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$this->response_type}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, Request $request)
    {
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $this->order_repository->delete($id);

        return response('', HttpResponseStatusCodeEnum::NO_CONTENT)
            ->header("Content-Type", "text/{$this->response_type}");
    }

}
