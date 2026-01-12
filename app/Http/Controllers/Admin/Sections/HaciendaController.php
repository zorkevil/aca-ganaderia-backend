<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use App\Models\MainBanner;
use App\Models\AllianceText;
use App\Models\Alliance;
use App\Models\Auction;
use App\Models\AuctionModality;
use App\Models\AuctionType;
use App\Models\AuctionText;
use Illuminate\View\View;

class HaciendaController extends Controller
{
    /**
     * Vista principal de la sección Hacienda
     */
    public function index(): View
    {
        // Identificador único de la sección
        $section = 'hacienda';

        /**
         * Banner principal
         * Se crea automáticamente si no existe
         */
        $banner = MainBanner::firstOrCreate(
            ['section' => $section],
            [
                'image_path' => null,
                'image_alt'  => '',
            ]
        );

        $allianceText = AllianceText::firstOrCreate(
            ['id' => 1],
            ['description' => '']
        );       

        $alliances = Alliance::orderBy('name')->get();

        $auctions = Auction::with(['modality', 'type'])
            ->orderByDesc('date')
            ->paginate(config('pagination.auctions'));

        $auctionText = AuctionText::firstOrCreate(
            ['id' => 1],
            ['description' => '']
        );  

        $modalities = AuctionModality::orderBy('name')->get();
        $types = AuctionType::orderBy('name')->get();

        return view('admin.sections.hacienda.index', compact(
            'section',
            'banner',
            'allianceText', 
            'alliances',
            'auctions',
            'auctionText',
            'modalities',
            'types'
        ));
    }
}
