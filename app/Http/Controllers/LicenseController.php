<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLicenseRequest;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(License::class, 'license');
    }
    public function index()
    {
        return License::with('project')->paginate(15);
    }

    public function store(StoreLicenseRequest $request)
    {
        $license = License::create($request->validated());
        return response()->json($license, 201);
    }

    public function show(License $license)
    {
        return $license->load(['conditionals', 'attachments']);
    }

    public function update(StoreLicenseRequest $request, License $license)
    {
        $license->update($request->validated());
        return response()->json($license);
    }

    public function destroy(License $license)
    {
        $license->delete();
        return response()->noContent();
    }
}
