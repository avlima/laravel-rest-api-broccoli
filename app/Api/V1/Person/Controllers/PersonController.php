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
        if (isset($request->response_type)) {
            $this->response_type = $request->response_type;
        }

        $persons = $this->person_repository->getAll($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $persons = self::httpResponse($persons, $this->response_type);
        }

        return response($persons, HttpResponseStatusCodeEnum::OK)
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

        $person = $this->person_repository->getById($id)->toArray();

        if ($this->response_type !== 'json') {
            $person = self::httpResponse($person, $this->response_type);
        }

        return response($person, HttpResponseStatusCodeEnum::OK)
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

        $person = $this->person_repository->create($request->all())->toArray();

        if ($this->response_type !== 'json') {
            $person = self::httpResponse($person, $this->response_type);
        }

        return response($person, HttpResponseStatusCodeEnum::CREATE)
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

        $person = $this->person_repository->update($request->all(), $id)->toArray();

        if ($this->response_type !== 'json') {
            $person = self::httpResponse($person, $this->response_type);
        }

        return response($person, HttpResponseStatusCodeEnum::OK)
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

        $this->person_repository->delete($id);

        return response('', HttpResponseStatusCodeEnum::NO_CONTENT)
            ->header("Content-Type", "text/{$this->response_type}");
    }

}
