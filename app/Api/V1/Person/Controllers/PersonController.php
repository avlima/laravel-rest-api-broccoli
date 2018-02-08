<?php

namespace  App\Api\V1\Person\Controllers;

use App\Api\V1\Person\Contracts\PersonRepositoryInterface;
use App\Api\V1\Person\Providers\PersonServiceProvider;
use App\Enum\HttpResponseStatusCodeEnum;
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
        $response_type = ($request->response_type) ?: 'json';

        $persons = $this->person_repository->getAll()->toArray();

        if ($response_type !== 'json') {
            $persons = self::httpResponse($persons, $response_type);
        }

        return response($persons, HttpResponseStatusCodeEnum::OK)
            ->header("Content-Type", "text/{$response_type}");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
