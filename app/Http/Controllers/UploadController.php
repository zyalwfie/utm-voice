<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function uploadCarousel(Request $request)
    {
        $request->validate([
            'filepond' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        if ($request->hasFile('filepond')) {
            $file = $request->file('filepond');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Store in temporary directory
            $path = $file->storeAs('temp/carousel', $filename, 'public');

            return response($filename, 200, [
                'Content-Type' => 'text/plain'
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadDetail(Request $request)
    {
        $request->validate([
            'filepond' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        if ($request->hasFile('filepond')) {
            $file = $request->file('filepond');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Store in temporary directory
            $path = $file->storeAs('temp/detail', $filename, 'public');

            return response($filename, 200, [
                'Content-Type' => 'text/plain'
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function deleteFile($filename)
    {
        try {
            // Delete from both possible temp directories
            $carouselPath = 'temp/carousel/' . $filename;
            $detailPath = 'temp/detail/' . $filename;

            if (Storage::disk('public')->exists($carouselPath)) {
                Storage::disk('public')->delete($carouselPath);
            }

            if (Storage::disk('public')->exists($detailPath)) {
                Storage::disk('public')->delete($detailPath);
            }

            return response($filename, 200, [
                'Content-Type' => 'text/plain'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete file'], 500);
        }
    }
}
