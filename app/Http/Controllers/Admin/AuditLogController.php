<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = AuditLog::with('user')
            ->when($request->action, function ($query, $action) {
                $query->where('action', 'like', "%{$action}%");
            })
            ->when($request->entity_type, function ($query, $entityType) {
                $query->where('entity_type', $entityType);
            })
            ->when($request->date_from, function ($query, $dateFrom) {
                $query->where('created_at', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($query, $dateTo) {
                $query->where('created_at', '<=', $dateTo);
            })
            ->latest()
            ->paginate(30);

        $actions = AuditLog::distinct()->pluck('action');

        return view('admin.audit-logs.index', compact('logs', 'actions'));
    }
}
