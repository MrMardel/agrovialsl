<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return file_get_contents(public_path('index.html'));
})->where('any', '.*');

Route::post('/test-graphql', function (Illuminate\Http\Request $request) {
    \Log::info('Cuerpo recibido en test-graphql', $request->all());
    return response()->json($request->all());
});
