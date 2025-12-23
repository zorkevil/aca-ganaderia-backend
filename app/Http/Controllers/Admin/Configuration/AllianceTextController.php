<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\AllianceText;
use Illuminate\Http\Request;

class AllianceTextController extends Controller
{
    public function update(Request $request, AllianceText $allianceText)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $allianceText->update([
            'description' => $request->description,
        ]);

        return redirect()
            ->back()
            ->with('status', 'Texto de alianzas actualizado');
    }
}
