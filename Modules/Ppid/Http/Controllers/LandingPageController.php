<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\Ppid\Entities\Berita;
use Modules\Ppid\Entities\Datadokumen;
use Modules\Ppid\Entities\DataInformasi;
use Modules\Ppid\Entities\KelolaProfil;
use Modules\Ppid\Entities\Menu;
use Modules\Ppid\Entities\Pengumuman;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('ppid::landing-page.pages.beranda');
    }

    public function beritaIndex(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;
        $offset = ($page - 1) * $perPage;

        $news = DB::select("SELECT * FROM berita LIMIT ? OFFSET ?", [$perPage, $offset]);
        $totalRows = DB::selectOne("SELECT COUNT(*) as total FROM berita");
        $totalNews = $totalRows->total;

        return view('ppid::landing-page.pages.publikasi.berita.index', [
            'news' => $news,
            'current_page' => $page,
            'last_page' => ceil($totalNews / $perPage),
            'per_page' => $perPage,
            'total' => $totalNews
        ]);
    }

    public function beranda()
    {
        return view('ppid::landing-page.pages.beranda');
    }

    public function beritaDetail($id)
    {
        $berita = Berita::findOrFail($id);
        return view('ppid::landing-page.pages.publikasi.berita.detail', compact('berita'));
    }

    public function pengumumanIndex(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;
        $offset = ($page - 1) * $perPage;

        $news = DB::select("SELECT * FROM pengumumen LIMIT ? OFFSET ?", [$perPage, $offset]);
        $totalRows = DB::selectOne("SELECT COUNT(*) as total FROM pengumumen");
        $totalNews = $totalRows->total;

        return view('ppid::landing-page.pages.publikasi.pengumuman.index', [
            'news' => $news,
            'current_page' => $page,
            'last_page' => ceil($totalNews / $perPage),
            'per_page' => $perPage,
            'total' => $totalNews
        ]);
    }

    public function pengumumanDetail($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('ppid::landing-page.pages.publikasi.pengumuman.detail', compact('pengumuman'));
    }

    public function informasiSetiapSaatIndex()
    {
        $datainformasi = DataInformasi::with('jenisInformasi')
            ->whereHas('jenisInformasi', function ($query) {
                $query->where('jenis_informasi', 'Informasi Setiap Saat');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.informasi-setiap-saat', compact('datainformasi'));
    }

    public function informasiBerkalaIndex()
    {
        $datainformasi = DataInformasi::with('jenisInformasi')
            ->whereHas('jenisInformasi', function ($query) {
                $query->where('jenis_informasi', 'Informasi Berkala');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.informasi-berkala', compact('datainformasi'));
    }

    public function informasiSertaMertaIndex()
    {
        $datainformasi = DataInformasi::with('jenisInformasi')
            ->whereHas('jenisInformasi', function ($query) {
                $query->where('jenis_informasi', 'Informasi Serta-merta');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.informasi-serta-merta', compact('datainformasi'));
    }

    public function informasiDikecualikanIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Informasi Yang Dikecualikan');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.informasi-dikecualikan', compact('dataDokumen'));
    }

    public function regulasiIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Regulasi');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.regulasi', compact('dataDokumen'));
    }

    public function informasiPublikIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Daftar Informasi Publik');
            })
            ->get();
        return view('ppid::landing-page.pages.informasi-publik.informasi-publik', compact('dataDokumen'));
    }

    public function maklumatPelayananIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Maklumat Pelayanan');
            })
            ->get();
        return view('ppid::landing-page.pages.layanan-informasi.maklumat-layanan', compact('dataDokumen'));
    }

    public function standarPelayananIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Standar Layanan');
            })
            ->get();
        return view('ppid::landing-page.pages.layanan-informasi.standar-layanan', compact('dataDokumen'));
    }

    public function prosedurPermohonanInformasiIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Prosedur Pengajuan Permohonan Informasi');
            })
            ->get();
        return view('ppid::landing-page.pages.layanan-informasi.permohonan-informasi', compact('dataDokumen'));
    }

    public function prosedurKeberatanInformasiIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Prosedur Pengajuan Keberatan Informasi');
            })
            ->get();
        return view('ppid::landing-page.pages.layanan-informasi.keberatan-informasi', compact('dataDokumen'));
    }

    public function prosedurPenyelesaianSengketaIndex()
    {
        $dataDokumen = Datadokumen::with('jenisDokumens')
            ->whereHas('jenisDokumens', function ($query) {
                $query->where('jenis_dokumen', 'Prosedur Penyelesaian Sengketa');
            })
            ->get();
        return view('ppid::landing-page.pages.layanan-informasi.penyelesaian-sengketa', compact('dataDokumen'));
    }

    public function sambutanDirekturShow()
    {
        $profil = KelolaProfil::findOrFail(1);
        return view('ppid::landing-page.pages.profil.sambutan-direktur', compact('profil'));
    }

    public function visiMisiShow()
    {
        $profil = KelolaProfil::findOrFail(1);
        return view('ppid::landing-page.pages.profil.visi-misi', compact('profil'));
    }

    public function profilPpidShow()
    {
        $profil = KelolaProfil::findOrFail(1);
        return view('ppid::landing-page.pages.profil.profil-ppid', compact('profil'));
    }

    //
    public function testMenuPage()
    {
        $menus = Menu::getHierarchical();

        return view('ppid::test-menu', compact('menus'));
    }

    public function testMenu()
    {
        $menus = Menu::getHierarchical();

        return response()->json([
            'success' => true,
            'menus' => $menus,
            'menu_structure' => $this->formatMenuStructure($menus)
        ]);
    }

    private function formatMenuStructure($menus)
    {
        $structure = [];

        foreach ($menus as $menu) {
            $item = [
                'title' => $menu->title,
                'type' => $menu->type,
                'route_name' => $menu->route_name,
                'url' => $menu->url,
                'actual_url' => $menu->actual_url,
                'order' => $menu->order,
                'has_children' => $menu->has_children,
            ];

            if ($menu->children->isNotEmpty()) {
                $item['children'] = $this->formatMenuStructure($menu->children);
            }

            $structure[] = $item;
        }

        return $structure;
    }

    //crud menu items
    public function menuIndex()
    {
        $menus = Menu::getHierarchical();
        return view('ppid::kelola-web.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::rootItems()->get();
        $availableRoutes = $this->getAvailableRoutes();

        return view('ppid::kelola-web.create', compact('parentMenus', 'availableRoutes'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'route_name' => 'nullable:type,route|nullable|string',
            'parent_id' => 'nullable|exists:menu_items,id',
            'is_active' => 'boolean'
        ]);

        // Set order to last position
        $maxOrder = Menu::max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;
        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function show($id)
    {
        $menu = Menu::with('children')->findOrFail($id);
        return view('ppid::kelola-web.show', compact('menu'));
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $parentMenus = Menu::rootItems()->where('id', '!=', $id)->get();
        $availableRoutes = $this->getAvailableRoutes();

        return view('ppid::kelola-web.edit', compact('menu', 'parentMenus', 'availableRoutes'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'route_name' => 'nullable:type,route|nullable|string',
            'parent_id' => 'nullable|exists:menu_items,id',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->children()->delete();
        $menu->delete();

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus');
    }

    // untuk mengatur urutan menu
    public function reorder(Request $request)
    {
        $menusData = $request->input('menus');

        try {
            DB::beginTransaction();

            foreach ($menusData as $menuData) {
                Menu::where('id', $menuData['id'])->update([
                    'order' => $menuData['order'],
                    'parent_id' => $menuData['parent_id']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Menu order updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error updating menu order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all available Laravel route names
     */
    private function getAvailableRoutes()
    {
        return collect(Route::getRoutes()->getRoutesByName())
            ->keys()
            ->filter(function ($routeName) {
                return !str_starts_with($routeName, 'debugbar.') &&
                    !str_starts_with($routeName, 'ignition.') &&
                    !str_starts_with($routeName, 'admin.');
            })
            ->values()
            ->toArray();
    }
}
