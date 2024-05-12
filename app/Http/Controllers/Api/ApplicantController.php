<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table_applicant;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Table_applicant::with('vacancy','candidate')->get();

        //return collection of data as a resource
        return new PostResource(true, 'List Data', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Validasi input
        $validator = Validator::make($request->all(), [
            'vacancy_id' => 'required|exists:table_vacancy,vacancy_id',
            'candidate_id' => 'required|exists:table_candidate,candidate_id',
            'apply_date' => 'required|date',
            'apply_status' => 'required|integer|min:0|max:1', // Sesuaikan dengan kebutuha
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat kandidat baru
        $applicant = new Table_applicant();
        $applicant->vacancy_id = $request->vacancy_id;
        $applicant->candidate_id = $request->candidate_id;
        $applicant->apply_date = $request->apply_date;
        $applicant->apply_status = $request->apply_status;

        // Simpan kandidat
        $applicant->save();


        return new PostResource(true, 'Data saved!', $applicant);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Temukan kandidat berdasarkan candidate_id
        $applicant = Table_applicant::where('applicant_id', $id)->with('vacancy','candidate')->first();

        return new PostResource(true, 'Detail Data!', $applicant);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // // Validasi input
        $validator = Validator::make($request->all(), [
            'vacancy_id' => 'required|exists:table_vacancy,vacancy_id',
            'candidate_id' => 'required|exists:table_candidate,candidate_id',
            'apply_date' => 'required|date',
            'apply_status' => 'required|integer|min:0|max:1', // Sesuaikan dengan kebutuha
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Temukan kandidat berdasarkan candidate_id
        $applicant = Table_applicant::where('applicant_id', $id)->first();

        // Periksa apakah kandidat ditemukan
        if (!$applicant) {
            return response()->json(['message' => 'Kandidat tidak ditemukan'], 404);
        }

        $applicant->vacancy_id = $request->vacancy_id;
        $applicant->candidate_id = $request->candidate_id;
        $applicant->apply_date = $request->apply_date;
        $applicant->apply_status = $request->apply_status;

        // Simpan kandidat
        $applicant->save();


        return new PostResource(true, 'Data updated!', $applicant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Temukan kandidat berdasarkan candidate_id
         $applicant = Table_applicant::where('applicant_id', $id)->first();
         $applicant->delete();

         return new PostResource(true, 'Data Deleted!', $applicant);
    }
}
