<?php

namespace App\Http\Controllers\Nova;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class SuppliersController extends Controller
{
    use ValidatesRequests;

    public function downloadCsv(Request $request, ResponseFactory $response)
    {
        $data = $this->validate($request, [
            'path' => 'required',
            'filename' => 'required',
        ]);

        return $response->download(
            decrypt($data['path']),
            $data['filename']
        )->deleteFileAfterSend($shouldDelete = true);
    }
}
