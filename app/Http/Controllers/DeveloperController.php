<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\DeveloperCollection;
use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Requests\UpdateDeveloperRequest;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/developers",
     *     description="Displays all the developers",
     *     tags={"Developers"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Developers in JSON format"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return new DeveloperCollection(Developer::all());
        return new DeveloperCollection(Developer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreDeveloperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeveloperRequest $request)
    {
        $developer = Developer::create([
            'name' => $request->name,
            'address' => $request->address,
            'biography' => $request->biography
        ]);

        return new DeveloperResource($developer);
    }

    /**
     * Display the specified resource.
     * 
     *  * @OA\Get(
    *     path="/api/developers/{id}",
    *     description="Gets a developer by ID",
    *     tags={"Developers"},
    *          @OA\Parameter(
    *          name="id",
    *          description="Developer id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer")
    *          ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation"
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    * )
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(Developer $developer)
    {
        return new DeveloperResource($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeveloperRequest $request, Developer $developer)
    {
        $developer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
