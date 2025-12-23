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
        $path = $request->file('icon')->store('alliances', 'public');

        Alliance::create([
            'icon_path' => $path,
            'name'      => $request->name,
            'alt'       => $request->alt,
            'link'      => $request->link,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->back()
            ->with('status', 'Alianza creada');
    }

    public function update(UpdateAllianceRequest $request, Alliance $alliance)
    {
        $data = $request->only(['name', 'alt', 'link']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($alliance->icon_path);
            $data['icon_path'] = $request->file('icon')->store('alliances', 'public');
        }

        $alliance->update($data);

        return redirect()
            ->back()
            ->with('status', 'Alianza actualizada');
    }

    public function destroy(Alliance $alliance)
    {
        Storage::disk('public')->delete($alliance->icon_path);
        $alliance->delete();

        return redirect()
            ->back()
            ->with('status', 'Alianza eliminada');
    }
}
