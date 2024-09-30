<?php

namespace App\Http\Controllers;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Achebe net API Documentation",
     *      description="API for Achebe net",
     *      @OA\Contact(
     *          email="ofuasiasoluchukwu@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *  @OA\SecurityScheme(
 *         securityScheme="Sanctum",
 *         type="http",
 *         scheme="bearer",
 *         bearerFormat="JWT",
 *         description="Enter your bearer token in the format **Bearer &lt;token&gt;**"
 *     )
     *
     * @OA\Server(
     *      url="https://achebe-net-backend.onrender.com/",
     *      description="Achebe-net API Server"
     * )

     *
     *
     */
abstract class Controller
{
    //
}
