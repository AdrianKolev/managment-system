<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Usage;
use Illuminate\Http\Request;
use App\Http\Resources\UsageResource;

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

    public function export()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=usages.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $usages = Usage::all();
            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Name', 'Email', 'Item Title', 'Quantity']);

            foreach ($usages as $usage) {
                fputcsv($file, [$usage->id, $usage->name, $usage->email, '', '', '']);

                foreach ($usage->usageItems as $usageItem) {
                    fputcsv($file, ['', '', '', $usageItem->item_title, $usageItem->quantity]);
                }
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function chart()
    {
        return Usage::query()
            ->join('usage_items', 'usages.id', '=', 'usage_items.usage_id')
            ->selectRaw("DATE_FORMAT(usages.created_at, '%Y-%m-%d') as date, SUM(usage_items.quantity * 1) as sum")
            ->groupBy('date')
            ->get();
    }
}
