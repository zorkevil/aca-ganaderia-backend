<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\Alliance\StoreAllianceRequest;
use App\Http\Requests\Admin\Configuration\Alliance\UpdateAllianceRequest;
use App\Models\Alliance;
use Illuminate\Support\Facades\Storage;

class AllianceController extends Controller
{
    public function store(StoreAllianceRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'alliances';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        Alliance::create($data);

        return redirect()
            ->back()
            ->with('status', 'Alianza creada');
    }

    public function update(UpdateAllianceRequest $request, Alliance $alliance)
    {
        $data = $request->only(['name', 'alt', 'link']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon')) {
            if ($alliance->icon_path) {
                Storage::disk('images')->delete($alliance->icon_path);
            }

            $file = $request->file('icon');
            $filename = $file->hashName();
            $directory = 'alliances';

            $file->storeAs($directory, $filename, 'images');

            $fullPath = $directory . '/' . $filename;
            if (Storage::disk('images')->exists($fullPath)) {
                $data['icon_path'] = $fullPath;
            } 
        }

        $alliance->update($data);

        return redirect()
            ->back()
            ->with('status', 'Alianza actualizada');
    }

    public function destroy(Alliance $alliance)
    {
        if ($alliance->icon_path) {
            Storage::disk('images')->delete($alliance->icon_path);
        }
        $alliance->delete();

        return redirect()
            ->back()
            ->with('status', 'Alianza eliminada');
    }
}
