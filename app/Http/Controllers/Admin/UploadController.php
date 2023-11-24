<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;

class UploadController extends Controller
{
    protected $upload;

    /**
     *  Upload picture for product
     * @param UploadService $upload
 */
    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    /**
     *  Show image information after selecting to check the correct image and correct path
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
 */
    public function store(Request $request)
    {

        $url = $this->upload->store($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url'   => $url
            ]);
        }
        return response()->json(['error' => true]);
    }
}
