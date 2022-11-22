<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\MotivationResource;
use App\Models\Product;
use Validator;
use App\Http\Resources\ProductResource;
use App\Models\Motivation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class MotivationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $motivations = Motivation::all()->with(['user']);
        $motivations =
        DB::table('motivations')
        ->select([
            // 'users.id',
            'users.name',
            'users.job',
            'users.email',
            'roles.role',
            'motivations.*',
            ])
        ->join('users', 'users.id', '=', 'motivations.user_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->get();
        return response()->json($motivations);

    }
    public function indexByAuth()
    {

        // $motivations = Motivation::all()->with(['user']);
        $motivations =
        DB::table('motivations')
        ->select([
            // 'users.id',
            'users.name',
            'users.job',
            'users.email',
            'roles.role',
            'motivations.*',
            ])
        ->where('user_id','=',auth()->user()->id)
        ->join('users', 'users.id', '=', 'motivations.user_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->get();
        return response()->json($motivations);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = FacadesValidator::make($input, [
            // 'name' => 'required',
            'motivation' => 'required'
        ]);

        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors())
            return response()->json($validator->errors(),status:400);
        }

        // $motivation = Motivation::create([
        //     'motivation'    =>  $request->motivation,
        // ]);
        $motivation = Motivation::create($input);

        // return $this->sendResponse(new MotivationResource($mot   ivation), 'Motivation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motivation = DB::table('motivations')
        ->select('motivations.*')
        ->where('id',$id)
        ->first();

        if (is_null($id)) {
            // return $this->sendError('Motivation not found.');
            // return "Motivation Not Found";
            return response()->json(status:404);
        }
        if ($motivation->user_id != auth()->user()->id) {
            // return $this->sendError('rejected');
            return response()->json(status:403);
        }
        // response()->json(false);
        return $motivation;

        // return $this->sendResponse(new MotivationResource($motivation), 'Motivation retrieved successfully.');
    }

    // public function showMotivationByUser()
    // {
    //     $motivation = Motivation::where('user_id',auth()->user()->id)->with(['user'])->get();
    //     return $this->sendResponse(new MotivationResource($motivation), 'Motivation retrieved successfully.');
    // }
    // public function editMotivationByUser($id)
    // {
    //     $motivation = Motivation::where('id',$id)->first();
    //     return $this->sendResponse(new MotivationResource($motivation), 'Motivation retrieved successfully.');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motivation $motivation)
    {
        $input = $request->all();

        $validator = FacadesValidator::make($input, [
            // 'name' => 'required',
            'motivation' => 'required'
        ]);

        if($validator->fails()){
            // return $this->sendError('Validation Error.', $validator->errors());
            return response()->json($validator->errors(),status:400);
        }

        // $motivation->name = $input['name'];
        $motivation->motivation = $input['motivation'];
        // $motivation->motivation = $input['motivation'];
        $motivation->save();

        return response()->json($motivation);
        // return $this->sendResponse(new MotivationResource($motivation), 'Motivation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motivation $motivation)
    {
        if ($motivation) {
            $motivation->delete();
            return response()->json();
        }
        return response()->json(status:404);

        // return $this->sendResponse([], 'Motivation deleted successfully.');
    }
}
