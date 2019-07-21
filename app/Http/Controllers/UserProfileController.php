<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Neo4jRepository;
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
        $this->neo4jRepository->run("CREATE (:User{
            first_name: 'Dat' ,
            last_name: 'Dang'
        })");

        return response()->json(['result' => 'query added'], 200);

        $this->validate($request, [
            'firstName' => 'required|alpha|min:2',
            'lastName' => 'required|alpha|min:2',
            'gender' => 'required|numeric|max:1',
            'birthDate' => 'required|date_format:dd/mm/yyyy',
            'phone' => 'required|numeric',
            'governmentId' => 'required',
            'language' => 'required|numeric|max:2',
            'currency' => 'required|numeric|max:2',
            'address' => 'required',
            'introduction' => 'required|min:3'
        ]);
        $query = "CREATE ";

        $this->neo4jRepository->run("");

        return response()->json(['id' => '1234'], 200);
    }
}
