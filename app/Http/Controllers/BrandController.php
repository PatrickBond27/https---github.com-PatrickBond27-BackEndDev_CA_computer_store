<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/brands",
     *     description="Displays all the brands",
     *     tags={"Brands"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation, Returns a list of Brands in JSON format"
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
        // return new BrandCollection(Brand::all());
        return new BrandCollection(Brand::all());
    }

    /**
     * Store a newly created resource (brand) in storage.
     *
     * @param  \Illuminate\Http\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     * 
     * @OA\Get(
    *     path="/api/brands/{id}",
    *     description="Gets a brand by ID",
    *     tags={"Brands"},
    *          @OA\Parameter(
    *          name="id",
    *          description="Brand id",
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
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
