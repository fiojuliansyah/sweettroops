<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;

class HomePageController extends Controller
{
    public function index()
    {
        $homepage = Homepage::orderBy('created_at', 'ASC')->first();

        return view('admin.homepages.index', compact('homepage'));
    }

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'detail' => 'required|string',
            'tab_1' => 'required|string',
            'title_tab_1' => 'required|string|max:255',
            'detail_tab_1' => 'required|string',
            'tab_2' => 'required|string',
            'title_tab_2' => 'required|string|max:255',
            'detail_tab_2' => 'required|string',
            'tab_3' => 'required|string',
            'title_tab_3' => 'required|string|max:255',
            'detail_tab_3' => 'required|string',
            'section_title' => 'required|string|max:255',
            'section_sub_title' => 'required|string|max:255',
            'section_detail' => 'required|string',
            'section_button' => 'required|string|max:255',
            'section_link' => 'required|string|max:255',
            'accord_title' => 'required|string|max:255',
            'accord_detail' => 'required|string',
            'accord_tab_1' => 'required|string|max:255',
            'accord_detail_tab_1' => 'required|string',
            'accord_tab_2' => 'required|string|max:255',
            'accord_detail_tab_2' => 'required|string',
            'accord_tab_3' => 'required|string|max:255',
            'accord_detail_tab_3' => 'required|string',
            'contact_title' => 'required|string|max:255',
            'contact_detail' => 'required|string',
            'email' => 'required|email|max:255',
            'hours' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'map_url' => 'required|string',
        ]);

        // Mencari data berdasarkan ID atau buat data baru jika ID tidak ada
        $homepage = HomePage::find($id);

        // Jika data ditemukan, update data tersebut, jika tidak ditemukan maka buat data baru
        if ($homepage) {
            // Update data yang ada
            $homepage->update($request->all());
        } else {
            // Buat data baru jika tidak ada data dengan ID yang diberikan
            $homepage = HomePage::create($request->all());
        }

        return redirect()->route('admin.homepages.index')->with('success', 'Homepage saved successfully.');
    }
}
