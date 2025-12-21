<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\MarketPresenter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\StoreReportRequest;
use App\Http\Requests\Admin\Reports\UpdateReportRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $marketPresenter = MarketPresenter::query()->first();

        $reports = Report::latest('date')
            ->paginate(config('pagination.reports'))
            ->withQueryString();

        return view('admin.reports.index', compact('marketPresenter', 'reports'));
    }

    public function store(StoreReportRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $report = new Report([
            'title' => $data['title'],
            'alt' => $data['alt'],
            'link' => $data['link'],
            'date' => $data['date'],
            'is_active' => (bool) $data['is_active'],
        ]);

        if ($request->hasFile('image')) {
            $report->image_path = $request->file('image')
                ->store('reports', 'images');
        }

        $report->save();

        return redirect()
            ->route('admin.reports.index')
            ->with('status', 'Informe creado.');
    }

    public function update(UpdateReportRequest $request, Report $report): RedirectResponse
    {
        $data = $request->validated();

        $report->fill([
            'title' => $data['title'],
            'alt' => $data['alt'],
            'link' => $data['link'],
            'date' => $data['date'],
            'is_active' => (bool) $data['is_active'],
        ]);

        if ($request->hasFile('image')) {
            if ($report->image_path) {
                Storage::disk('images')->delete($report->image_path);
            }

            $report->image_path = $request->file('image')
                ->store('reports', 'images');
        }

        $report->save();

        return redirect()
            ->route('admin.reports.index')
            ->with('status', 'Informe actualizado.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        if ($report->image_path) {
            Storage::disk('images')->delete($report->image_path);
        }

        $report->delete();

        return redirect()
            ->route('admin.reports.index')
            ->with('status', 'Informe eliminado.');
    }
}

