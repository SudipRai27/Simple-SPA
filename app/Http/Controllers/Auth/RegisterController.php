<?php

namespace App\Http\Controllers\Auth;

use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $user = (new RegisterService)->register($data);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return new JsonResponse([[], 'message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            DB::rollback();
            return new JsonResponse([[], 'message' => $e->getMessage()], Response::HTTP_NOT_IMPLEMENTED);
        }
        return new JsonResponse(['data' => $user, 'message' => 'Signed up successfully'], 201);
    }
}