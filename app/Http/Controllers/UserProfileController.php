<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function getProfile()
    {
        $uuid = Auth::id();

        try {
            $userData = $this->userRepository->getUserData($uuid);

            return response()->json(['data' => $userData], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Can not save user data!'], 500);
        }
    }

    public function saveProfile(Request $request)
    {
        $this->validateProfile($request);

        $uuid = Auth::id();

        $data = [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'gender' => $request->input('gender'),
            'birthDate' => $this->convertDateToStandard($request->input('birthDate')),
            'phone' => $request->input('phone'),
            'governmentId' => $request->input('governmentId'),
            'language' => $request->input('language'),
            'currency' => $request->input('currency'),
            'address' => $request->input('address'),
            'introduction' => $request->input('introduction')
        ];

        try {
            $this->userRepository->saveUserData($uuid, $data);
            return response()->json(['msg' => 'success'], 200);

        } catch (Exception $e) {
            return response()->json(['msg' => 'Can not save user data!'], 500);
        }
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

    private function convertDateToStandard(string $date)
    {
        $date = str_replace('/', '-', $date);
        return date("Y-m-d", strtotime($date));
    }
}
