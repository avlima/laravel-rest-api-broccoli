<?php

namespace  App\Api\V1\Person\Controllers;

use App\Api\V1\Person\Contracts\PersonRepositoryInterface;
use App\Api\V1\Person\Providers\PersonServiceProvider;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Http\Controllers\Controller;
use App\Utils\HttpResponseUtils;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    use HttpResponseUtils;

    /**
     * @var PersonServiceProvider
     */
    private $person_repository;

    /**
     * PersonController constructor.
     *
     * @param PersonRepositoryInterface $person_repository
     */
    public function __construct(PersonRepositoryInterface $person_repository)
    {
        $this->person_repository = $person_repository;
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
        $response_type = 'json';

        if (isset($request->response_type)) {
            $response_type = $request->response_type;
        }

        $persons = $this->person_repository->getAll()->toArray();

        if ($response_type !== 'json') {
            $persons = self::httpResponse($persons, $response_type);
        }

        return response($persons, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$response_type}");
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid, Request $request)
    {
        $response_type = 'json';

        if (isset($request->response_type)) {
            $response_type = $request->response_type;
        }

        $person = $this->person_repository->getByUuid($uuid)->toArray();

        if ($response_type !== 'json') {
            $person = self::httpResponse($person, $response_type);
        }

        return response($person, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$response_type}");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response_type = 'json';

        if (isset($request->response_type)) {
            $response_type = $request->response_type;
        }

        $person = $this->person_repository->create($request->all())->toArray();

        if ($response_type !== 'json') {
            $person = self::httpResponse($person, $response_type);
        }

        return response($person, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$response_type}");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
