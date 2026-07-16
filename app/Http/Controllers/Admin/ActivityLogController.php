<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $activities = Activity::query()->with(['causer', 'subject']);

            if ($request->filled('event')) {
                $activities->where('event', $request->event);
            }

            return DataTables::of($activities)
                ->addColumn('user', function ($activity) {
                    return $activity->causer?->name ?? 'System';
                })

                ->addColumn('target', function ($activity) {
                    return $activity->subject?->name ?? $activity->subject?->id ?? 'N/A';
                })

                ->editColumn('event', function ($activity) {
                    return match ($activity->event) {
                        'created' => '<span class="text-green-600 font-semibold">Created</span>',
                        'updated' => '<span class="text-yellow-600 font-semibold">Updated</span>',
                        'deleted' => '<span class="text-red-600 font-semibold">Deleted</span>',
                        default => $activity->event,
                    };
                })

                ->editColumn('created_at', function ($activity) {
                    return $activity->created_at->format('Y-m-d H:i:s');
                })

                ->rawColumns(['event'])
                ->make(true);
        }

        return view('admin.activity-logs.index');
    }
}
