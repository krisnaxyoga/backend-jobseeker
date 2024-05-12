<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table_vacancy;
use App\Models\Table_applicant;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class VacancyController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Table_vacancy::orderBy('created_at', 'desc')->get();

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
                'vacancy_name' => 'required|string',
                'min_exp' => 'required|integer|min:0',
                'max_age' => 'nullable|integer|min:0',
                'salary' => 'required|string',
                'description' => 'required|string',
                'publish_date' => 'required|date',
                'expired_date' => 'required|date|after:publish_date',
                'flag_status' => 'required|integer|in:0,1',
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat kandidat baru
        $vacancy = new Table_vacancy();
        $vacancy->vacancy_name = $request->vacancy_name;
        $vacancy->min_exp = $request->min_exp;
        $vacancy->max_age = $request->max_age;
        $vacancy->salary = $request->salary;
        $vacancy->description = $request->description;
        $vacancy->publish_date = $request->publish_date;
        $vacancy->expired_date = $request->expired_date;
        $vacancy->flag_status = $request->flag_status;

        // Simpan kandidat
        $vacancy->save();


        return new PostResource(true, 'Data saved!', $vacancy);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Temukan kandidat berdasarkan candidate_id
        $vacancy = Table_vacancy::where('vacancy_id', $id)->first();

        return new PostResource(true, 'Detail Data!', $vacancy);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // // Validasi input
        $validator = Validator::make($request->all(), [
                'vacancy_name' => 'required|string',
                'min_exp' => 'required|integer|min:0',
                'max_age' => 'nullable|integer|min:0',
                'salary' => 'required|string',
                'description' => 'required|string',
                'publish_date' => 'required|date',
                'expired_date' => 'required|date|after:publish_date',
                'flag_status' => 'required|integer|in:0,1',
        ]);

        // // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Temukan kandidat berdasarkan candidate_id
        $vacancy = Table_vacancy::where('vacancy_id', $id)->first();

        // Periksa apakah kandidat ditemukan
        if (!$vacancy) {
            return response()->json(['message' => 'Kandidat tidak ditemukan'], 404);
        }

        $vacancy->vacancy_name = $request->vacancy_name;
        $vacancy->min_exp = $request->min_exp;
        $vacancy->max_age = $request->max_age;
        $vacancy->salary = $request->salary;
        $vacancy->description = $request->description;
        $vacancy->publish_date = $request->publish_date;
        $vacancy->expired_date = $request->expired_date;
        $vacancy->flag_status = $request->flag_status;

        // Simpan kandidat
        $vacancy->save();


        return new PostResource(true, 'Data updated!', $vacancy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {

            $applicant = Table_applicant::where('vacancy_id', $id)->first();

            if ($applicant) {
                $applicant->delete();
            }

            $vacancy = Table_vacancy::where('vacancy_id', $id)->first();

            if ($vacancy) {
                $vacancy->delete();
            }

            return new PostResource(true, 'Data Deleted', $vacancy);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete data: ' . $e->getMessage()
            ], 500);
        }
    }
}
