<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        // 查詢快取
        $url = $request->url();
        $queryParams = $request->query();
        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$url}?{$queryString}";

        if (Cache::has($fullUrl)) {            
            return Cache::get($fullUrl);
        }

        // limit
        $limit = $request->limit ?? 10;
        //$animals = Animal::get();
        $animals = Animal::orderBy( 'id', 'desc')
        ->paginate($limit)
        ->appends($request->query());

        return Cache::remember($fullUrl, 60, function() use ($animals) {
            $c_time = time();
            return response([ 'data' => $animals, 'c_time' => $c_time ], Response::HTTP_OK );
        });        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $animal = Animal::create($request->all());
        $animal = $animal->refresh();
        return response( $animal, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
        return response( $animal, Response::HTTP_OK );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        //
        $animal->update( $request->all() );
        return response( $animal, Response::HTTP_OK );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        //
        $animal->delete();
        return response( null, Response::HTTP_NO_CONTENT);
    }
}
