<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $institution = $request->user()->adminProfile?->institution;

        $logs = AuditLog::with('user')
            ->when($request->action, function ($query, $action) {
                $query->where('action', 'like', "%{$action}%");
            })
            ->when($request->date_from, function ($query, $dateFrom) {
                $query->where('created_at', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($query, $dateTo) {
                $query->where('created_at', '<=', $dateTo);
            })
            ->latest()
            ->paginate(30);

        return view('institution.audit-logs.index', compact('logs'));
    }
}
