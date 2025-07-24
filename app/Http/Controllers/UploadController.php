<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadCarousel(Request $request)
    {
        $request->validate([
            'carousel' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('carousel')) {
            $path = $request->file('carousel')->store('tmp/carousel', 'public');

            $filename = basename($path);

            return response($filename, 200, [
                'Content-Type' => 'text/plain'
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadDetail(Request $request)
    {
        $request->validate([
            'detail' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($request->hasFile('detail')) {
            $path = $request->file('detail')->store('tmp/detail', 'public');

            $filename = basename($path);

            return response($filename, 200, [
                'Content-Type' => 'text/plain'
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function deleteFile($filename)
    {
        try {
            $carouselPath = 'tmp/carousel/' . $filename;
            $detailPath = 'tmp/detail/' . $filename;

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
            return response()->json(['error' => 'Failed to delete file: ' . $e->getMessage()], 500);
        }
    }
}
