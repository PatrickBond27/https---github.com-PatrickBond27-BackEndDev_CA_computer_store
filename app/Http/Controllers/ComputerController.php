<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ComputerResource;
use App\Http\Resources\ComputerCollection;
use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/computers",
     *     description="Displays all the computers",
     *     tags={"Computers"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Computers in JSON format"
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
        // $computers = Computer::all();
        // return new ComputerCollection($computers);
        // return new ComputerCollection(Computer::all());
        return new ComputerCollection(Computer::with('brand')
        ->with('developers')
        ->get());
    }

    /**
     * Store a newly created resource (computer) in storage.
     *
     * @OA\Post(
     *      path="/api/computers",
     *      operationId="store",
     *      tags={"Computers"},
     *      summary="Create a new Computer",
     *      description="Stores the computer in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description", "brand", "graphics_card", "processor", "storage", "ram", "price", "brand_id", "developers"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this computer"),
     *            @OA\Property(property="brand", type="string", format="string", example="Dell"),
     *            @OA\Property(property="graphics_card", type="string", format="string", example="RTX 3070"),
     *            @OA\Property(property="processor", type="string", format="string", example="intel i9"),
     *            @OA\Property(property="storage", type="string", format="string", example="512 GB"),
     *            @OA\Property(property="ram", type="string", format="string", example="8 GB"),
     *            @OA\Property(property="price", type="string", format="string", example="1600"),
     *            @OA\Property(property="brand_id", type="json", format="json", example=2),
     *            @OA\Property(property="developers", type="json", format="json", example={1, 3})
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     *
     * @param  \Illuminate\Http\StoreComputerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComputerRequest $request)
    {
        // The attributes for the computer that takes from the Computer Model.
        $computer = Computer::create([
            'title' => $request->title, 
            'description' => $request->description, 
            'brand' => $request->brand, 
            'graphics_card' => $request->graphics_card, 
            'processor' => $request->processor, 
            'storage' => $request->storage, 
            'ram' => $request->ram, 
            'price' => $request->price, 
            'brand_id' => $request->brand_id
        ]);

        $computer->developers()->attach($request->developers);

        return new ComputerResource($computer);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
    *     path="/api/computers/{id}",
    *     description="Gets a computer by ID",
    *     tags={"Computers"},
    *          @OA\Parameter(
    *          name="id",
    *          description="Computer id",
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
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {
        // Returns and displays the specified resource (computer).
        return new ComputerResource($computer);
    }

    /**
     * Update the specified resource in storage.
     *
     * * @OA\Put(
     *      path="/api/computers/{id}",
     *      operationId="update",
     *      tags={"Computers"},
     *      summary="Update an existing Computer",
     *      description="Updates the computer in the DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(name="id", in="path", description="Id of a Computer", required=true,
     *        @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "description", "brand", "graphics_card", "processor", "storage", "ram", "price", "brand_id"},
     *            @OA\Property(property="title", type="string", format="string", example="Sample Title"),
     *            @OA\Property(property="description", type="string", format="string", example="A long description about this computer"),
     *            @OA\Property(property="brand", type="string", format="string", example="Me"),
     *            @OA\Property(property="graphics_card", type="string", format="string", example="Me"),
     *            @OA\Property(property="processor", type="string", format="string", example="Me"),
     *            @OA\Property(property="storage", type="string", format="string", example="Me"),
     *            @OA\Property(property="ram", type="string", format="string", example="Me"),
     *            @OA\Property(property="price", type="string", format="string", example="Me"),
     *            @OA\Property(property="developers", type="json", format="json", example={1, 3})
     *          )
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *     )
     * )
     * 
     * @param  \Illuminate\Http\UpdateComputerRequest  $request
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        // Updates the resource (computer).
        $computer->update($request->only([
            'title', 'description', 'brand', 'graphics_card', 'processor', 'storage', 'ram', 'price', 'brand_id'
        ]));

        $computer->developers()->attach($request->developers);

        return new ComputerResource($computer);
    }

    /**
     *
     *
     * @OA\Delete(
     *    path="/api/computers/{id}",
     *    operationId="destroy",
     *    tags={"Computers"},
     *    summary="Delete a Computer",
     *    description="Delete Computer",
     *      security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="id", in="path", description="Id of a Computer", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=Response::HTTP_NO_CONTENT,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="204"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */

     // Note $computer parameter passed in here.
    // If we had not enabled route model binding
    // when creating Controller and Model (using --Model)
    // there would only be a computer Id passed in here, and we'd have to
    // check to see if the computer exist.
    public function destroy(Computer $computer)
    {
        // Deletes the specified resource (computer).
        $computer->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
