<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use App\Models\Event;
use App\Models\ServiceHourRecord;
use App\Models\VolunteerProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $institution = $request->user()->adminProfile?->institution;

        $reports = ActivityReport::with(['event', 'author', 'reviewer'])
            ->whereHas('event', function ($query) use ($institution) {
                $query->where('institution_id', $institution?->id);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('review_status', $status);
            })
            ->latest()
            ->paginate(15);

        return view('institution.reports.index', compact('reports'));
    }

    public function show(ActivityReport $report): View
    {
        $report->load(['event', 'author', 'reviewer', 'attachments']);

        return view('institution.reports.show', compact('report'));
    }

    public function review(Request $request, ActivityReport $report): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'in:approve,reject'],
            'reviewer_comments' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validated['action'] === 'approve') {
            $report->update([
                'review_status' => ActivityReport::STATUS_APPROVED,
                'reviewer_comments' => $validated['reviewer_comments'],
                'reviewer_id' => $request->user()->id,
                'reviewed_at' => now(),
            ]);
        } else {
            if (empty($validated['reviewer_comments'])) {
                return back()->with('error', 'Rejection reason is required.');
            }

            $report->update([
                'review_status' => ActivityReport::STATUS_REJECTED,
                'reviewer_comments' => $validated['reviewer_comments'],
                'reviewer_id' => $request->user()->id,
                'reviewed_at' => now(),
            ]);
        }

        return back()->with('success', 'Report reviewed successfully.');
    }

    public function export(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $institution = $request->user()->adminProfile?->institution;

        $volunteers = VolunteerProfile::with(['unit', 'serviceHourRecords', 'attendanceRecords'])
            ->where('institution_id', $institution?->id)
            ->where('status', 'approved')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="volunteers-report-' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($volunteers) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Enrollment No', 'Name', 'Email', 'Phone', 'Course', 'Department',
                'Year', 'Unit', 'Total Approved Hours', 'Events Attended'
            ]);

            foreach ($volunteers as $volunteer) {
                fputcsv($file, [
                    $volunteer->enrollment_number,
                    $volunteer->full_name,
                    $volunteer->user?->email,
                    $volunteer->phone,
                    $volunteer->course,
                    $volunteer->department,
                    $volunteer->year_of_study,
                    $volunteer->unit?->name,
                    $volunteer->serviceHourRecords()->where('approval_status', 'approved')->sum('approved_hours'),
                    $volunteer->attendanceRecords()->whereIn('status', ['present', 'finalized'])->count(),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
