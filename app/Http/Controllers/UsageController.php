<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsageResource;
use App\Models\Usage;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public function index()
    {   
        $usages = Usage::with('usageItems')->paginate();
        return UsageResource::collection($usages);
    }

    public function show($id)
    {
        $usage = Usage::with('usageItems')->find($id);
        return new UsageResource($usage);
    }
}
