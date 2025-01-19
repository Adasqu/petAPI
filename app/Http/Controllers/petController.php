<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Exception;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $apiUrl = 'https://petstore.swagger.io/v2/pet/';
    public function index(Request $request)
    {
        //
        try {
            $id = $request->input('id');
            if ($id) {
                $response = Http::get($this->apiUrl . $id);
                if ($response->successful()) {
                    $pet = json_decode($response->getBody(), true);
                    return redirect()->route('pets.show', $pet['id']);
                } else {
                    return back()->with('error', 'Nie znaleziono zwierzęcia o podanym ID.');
                }
            }
            $status = $request->input('status', 'available');
            $response = Http::get($this->apiUrl . "findByStatus", ['status' => $status]);
            if ($response->successful()) {
                $pets = $response->json();
                //var_dump($pets);
                return view('pets.index', compact('pets', 'status'));
            } else {
                return redirect()->back()->with('error', 'Unable to fetch pets');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Nie znaleziono zwierzęcia o podanym ID.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $response = Http::post($this->apiUrl . '/pet', ['json' => $request->only('id', 'category', 'name', 'photoUrls', 'tags', 'status')]);
            $pet = json_decode($response->getBody(), true);
            if ($request->hasFile('file')) {
                $this->uploadFile($request, $pet['id']);
            }
            return redirect()->route('pets.show', $pet['id']);
        } catch (Exception $e) {
            return back()->with('error', 'Nie znaleziono zwierzęcia o podanym ID.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if ($id == null)
                return view('pets.show');

            $response = Http::get($this->apiUrl  . $id);
            if (!$response->successful())
                return back()->with('error', 'Nie znaleziono zwierzęcia o podanym ID.');
            $pet = json_decode($response->getBody(), true);
            return view('pets.show', compact('pet'));
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $response = Http::put($this->apiUrl  . $id, ['json' => $request->all()]);
            if (!$response->successful())
                return back()->with('error', 'Nie znaleziono zwierzęcia o podanym ID.');
            $pet = json_decode($response->getBody(), true);
            return redirect()->route('pets.show', $pet['id']);
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Http::delete($this->apiUrl . $id);
            return redirect()->route('pets.index');
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()], 500);
        }
    }
    public function uploadFile(Request $request, $id)
    {
        try {
            $file = $request->file('file');
            $response = Http::attach('file', file_get_contents($file), $file->getClientOriginalName())->post($this->apiUrl . $id . '/uploadImage');
            $result = json_decode($response->getBody(), true);
            return response()->json($result);
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()], 500);
        }
    }
}
