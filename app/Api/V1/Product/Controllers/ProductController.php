<?php

namespace  App\Api\V1\Product\Controllers;

use App\Api\V1\Product\Contracts\ProductRepositoryInterface;
use App\Api\V1\Product\Providers\ProductServiceProvider;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Utils\HttpResponseUtils;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HttpResponseUtils;

    /**
     * @var ProductServiceProvider
     */
    private $product_repository;

    /**
     * ProductController constructor.
     *
     * @param ProductRepositoryInterface $product_repository
     */
    public function __construct(ProductRepositoryInterface $product_repository)
    {
        $this->product_repository = $product_repository;
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

        $products = $this->product_repository->getAll($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $products = self::httpResponse($products, $this->response_type);
        }

        return response($products, HttpResponseStatusCodeEnum::OK)
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

        $product = $this->product_repository->getById($id)->toArray();

        if ($this->response_type !== 'json') {
            $product = self::httpResponse($product, $this->response_type);
        }

        return response($product, HttpResponseStatusCodeEnum::OK)
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

        $product = $this->product_repository->create($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $product = self::httpResponse($product, $this->response_type);
        }

        return response($product, HttpResponseStatusCodeEnum::CREATE)
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

        $product = $this->product_repository->update($request->all(), $id)->toArray();

        if ($this->response_type !== 'json') {
            $product = self::httpResponse($product, $this->response_type);
        }

        return response($product, HttpResponseStatusCodeEnum::OK)
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

        $this->product_repository->delete($id);

        return response('', HttpResponseStatusCodeEnum::NO_CONTENT)
            ->header("Content-Type", "text/{$this->response_type}");
    }

}
