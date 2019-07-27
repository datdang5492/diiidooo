<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Neo4jRepository;
use Exception;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * @var Neo4jRepository
     */
    private $neo4jRepository;

    /**
     * Create a new controller instance.
     *
     * @param Neo4jRepository $neo4jRepository
     */
    public function __construct(Neo4jRepository $neo4jRepository)
    {
        $this->middleware('auth');
        $this->neo4jRepository = $neo4jRepository;
    }

    public function saveProfile(Request $request)
    {
        $this->validateProfile($request);;

        $query = 'CREATE (:User $data);';
        $data = [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'gender ' => $request->input('gender'),
            'birthDate ' => $request->input('birthDate'),
            'phone ' => $request->input('phone'),
            'governmentId ' => $request->input('governmentId'),
            'language ' => $request->input('language'),
            'currency ' => $request->input('currency'),
            'address ' => $request->input('address'),
            'introduction ' => $request->input('introduction')
        ];

        try {
            $this->neo4jRepository->run($query, ['data' => $data]);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Can not save user data!'], 500);
        }


        return response()->json(['msg' => 'success'], 200);
    }

    private function validateProfile(Request $request): void
    {
        $this->validate($request, [
            'firstName' => 'required|alpha|min:2',
            'lastName' => 'required|alpha|min:2',
            'gender' => 'required|alpha|max:6',
            'birthDate' => 'required|date_format:d/m/Y',
            'phone' => 'required|numeric',
            'governmentId' => 'required',
            'language' => 'required|alpha|size:2',
            'currency' => 'required|alpha|size:3',
            'address' => 'required',
            'introduction' => 'required|min:3'
        ]);
    }
}
