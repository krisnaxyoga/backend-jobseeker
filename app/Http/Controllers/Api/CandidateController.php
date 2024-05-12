<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table_candidate;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Table_applicant;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datacandidatee = Table_candidate::orderBy('created_at', 'desc')->get();

        //return collection of datacandidatee as a resource
        return new PostResource(true, 'List Data', $datacandidatee);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:table_candidate,email',
            'phone_number' => 'required|unique:table_candidate,phone_number',
            'full_name' => 'required',
            'dob' => 'required',
            'pob' => 'required',
            'gender' => 'required', // Sesuaikan dengan pilihan gender yang ada
            'year_exp' => 'required',
            'last_salary' => 'required',
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat kandidat baru
        $candidate = new Table_candidate();
        $candidate->email = $request->email;
        $candidate->phone_number = $request->phone_number;
        $candidate->full_name = $request->full_name;
        $candidate->dob = $request->dob;
        $candidate->pob = $request->pob;
        $candidate->gender = $request->gender;
        $candidate->year_exp = $request->year_exp;
        $candidate->last_salary = $request->last_salary;

        // Simpan kandidat
        $candidate->save();


        return new PostResource(true, 'Data saved!', $candidate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datacandidatee = Table_candidate::where('candidate_id', $id)->first();

        //return collection of datacandidatee as a resource
        return new PostResource(true, 'Detail Data', $datacandidatee);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:table_candidate,email',
            'phone_number' => 'required|unique:table_candidate,phone_number',
            'full_name' => 'required',
            'dob' => 'required',
            'pob' => 'required',
            'gender' => 'required', // Sesuaikan dengan pilihan gender yang ada
            'year_exp' => 'required',
            'last_salary' => 'required',
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Temukan kandidat berdasarkan candidate_id
        $candidate = Table_candidate::where('candidate_id', $id)->first();

        // Periksa apakah kandidat ditemukan
        if (!$candidate) {
            return response()->json(['message' => 'Kandidat tidak ditemukan'], 404);
        }


        $candidate->email = $request->email;
        $candidate->phone_number = $request->phone_number;
        $candidate->full_name = $request->full_name;
        $candidate->dob = $request->dob;
        $candidate->pob = $request->pob;
        $candidate->gender = $request->gender;
        $candidate->year_exp = $request->year_exp;
        $candidate->last_salary = $request->last_salary;

        // Simpan kandidat
        $candidate->save();


        return new PostResource(true, 'Data updated!', $candidate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $applicant = Table_applicant::where('candidate_id', $id)->first();

            if ($applicant) {
                $applicant->delete();
            }

            $datacandidatee = Table_candidate::where('candidate_id', $id)->first();

            if ($datacandidatee) {
                $datacandidatee->delete();
            }

            return new PostResource(true, 'Data Deleted', $datacandidatee);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete data: ' . $e->getMessage()
            ], 500);
        }
    }
}
