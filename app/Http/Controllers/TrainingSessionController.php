<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class TrainingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingSession $trainingSession)
    {

        return view('training-session-show', compact('trainingSession'));
    }

    public function print(TrainingSession $trainingSession)
    {
        foreach ($trainingSession->exercises as $exercise) {
            $imagePath = public_path('storage/'.$exercise->image);
            $type = pathinfo($imagePath, PATHINFO_EXTENSION);
            $data = file_get_contents($imagePath);
            $exercise->base64Image = 'data:image/'.$type.';base64,'.base64_encode($data);
            foreach ($exercise->equipment as $equipment) {
                $imagePath = public_path('storage/'.$equipment->image);
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);
                $data = file_get_contents($imagePath);
                $equipment->base64Image = 'data:image/'.$type.';base64,'.base64_encode($data);
            }
        }
        $content = view('training-session-show-print', compact('trainingSession'))->render();
        $fileName = $trainingSession->slug.'.pdf';
        $pathToFile = storage_path('public/'.$fileName);
        Browsershot::html($content)
            ->format('A4')
            ->showBackground()
            ->setNodeBinary('C:\Program Files\\nodejs\\node.exe')
            ->noSandbox()
            ->pdf()
            ->savePdf($pathToFile);

        return response()->file($pathToFile)->deleteFileAfterSend(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
