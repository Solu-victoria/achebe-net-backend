<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validate;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;
    /**
*@OA\Get(
    *     path="/api/user",
    *     summary="Get authenticated user",
    *     description="Get the currently authenticated user.",
    *     operationId="getUser",
    *     tags={"User"},
    *     security={
    *         {"sanctum": {}}
    *     },
   * @OA\Response(
 *     response=200,
 *     description="Successful response",
 * * @OA\JsonContent(
 *             type="object",
    *     @OA\Property(
 *             property="data",
 *             type="object",
            * example={"user_property": "user_value"},
            * ),
 *         ),
 * ),
    * )
    */ 
    public function getUser(Request $request) { 
        //actual code found in api routes file, this is for swagger to generate doc for this route
    }
    
    /**
*@OA\Post(
    *     path="/api/connect-wallet",
    *     summary="Route to connect wallet",
    *     description="User register or login by connecting wallet",
    *     operationId="connectWallet",
    *     tags={"Wallet"},
     *@OA\RequestBody(
     *     @OA\JsonContent(),
     *     @OA\MediaType(
     *       mediaType="multipart/form-data",
     *       @OA\Schema(
     *         required={"wallet_id"},
     *         @OA\Property(property="wallet_id", type="string"),
     *       ),
     *     ),
     *   ),
  *  @OA\Response(
 *     response=201,
 *     description="Successful response",
 * @OA\JsonContent(
 *             type="object",
    *     @OA\Property(
 *             property="data",
 *             type="object",
            * example="Wallet connected successfully!",
 *         ),
 * ),
 * ),
 *  @OA\Response(
     *     response=400,
     *     description="Validation errors",
     *     @OA\JsonContent()
     *   ),
 
    * )
    */
    public function connectWallet(Request $request) { //create account with us using wallet_id or login using wallet_id. Returns auth token
        $validator = Validate::make($request->all(), [
            'wallet_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::where('wallet_id', $request->wallet_id)->first();
        if (!$user) {
            $user = User::create(['wallet_id' => $request->wallet_id]); //create account with us
        }
        $token = $user->createToken('user')->plainTextToken;
        return $this->success([
            'user' => $user->refresh(),
            'token' => $token,
            'message' => 'Wallet connected successfully!'
        ]);
    }
}
