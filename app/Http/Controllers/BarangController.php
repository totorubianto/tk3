<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorStoreRequest;
use App\Models\Barang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $administrators = Barang::select('nama_barang','deskripsi','jenis_barang','stock_barang','harga_beli','harga_jual','gambar_barang')->orderBy('nama_barang')->get();

        if (request()->ajax()) {
            return datatables()->of($administrators)
                ->addIndexColumn()
                ->addColumn('created_at', fn ($model) => date('d-m-Y H:i', strtotime($model->created_at)))
                ->addColumn('action', 'barang.datatable.action')
                ->toJson();
        }

        return view('barang.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdministratorStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdministratorStoreRequest $request): RedirectResponse
    {
        Barang::create([
            'nama_barang'=> $request->nama_barang,
            'deskripsi'=> $request->deskripsi,
            'jenis_barang'=> $request->jenis_barang,
            'stock_barang'=> $request->stock_barang,
            'harga_beli'=> $request->harga_beli,
            'harga_jual'=> $request->harga_jual,
            'gambar_barang'=> $request->gambar_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $administrator): RedirectResponse
    {
        $administrator->update([
            'nama_barang'=> $request->nama_barang,
            'deskripsi'=> $request->deskripsi,
            'jenis_barang'=> $request->jenis_barang,
            'stock_barang'=> $request->stock_barang,
            'harga_beli'=> $request->harga_beli,
            'harga_jual'=> $request->harga_jual,
            'gambar_barang'=> $request->gambar_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $administrator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $administrator): RedirectResponse
    {
        $administrator->delete();

        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus!');
    }
}
