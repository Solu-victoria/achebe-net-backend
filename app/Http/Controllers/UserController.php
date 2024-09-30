<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as Validate;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use HttpResponses;

     /**
*@OA\Post(
    *     path="/api/user/track-progress",
    *     summary="Track user progress",
    *     description="Route to notify that a question has been asked and receive response of current stage and if the user has entered a new stage",
    *     operationId="trackUserProgress",
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
    public function trackUserProgress(Request $request)
    {
        // Define the maximum number of recent questions before leveling up
        $MAX_RECENT_QUESTIONS = 15;

        $user = $request->user();
        $newLevel = false;
        if ($user->no_of_recent_questions_asked < $MAX_RECENT_QUESTIONS) {
            $user->increment('no_of_recent_questions_asked');

        }else {
            $user->no_of_recent_questions_asked = 0;
            $newLevel = true;
            $user->increment('level');
        }
        $user->save();
        $user->refresh();

        return $this->success([
            'newLevel' => $newLevel,
            'level' => $user->level,
        ]);

    }
}
