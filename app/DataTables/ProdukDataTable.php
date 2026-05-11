<?php

namespace App\DataTables;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProdukDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.produk.action', compact('query'));
            })
            ->addColumn('image', function ($query) {
                $url = asset('storage/assets/back/img/produk/' . $query->image);
                return "<img src='{$url}' style='width:60px; height:60px; object-fit:cover; border-radius:8px;'>";
            })
            ->addColumn('price', function ($query) {
                return "Rp " . number_format($query->price, 0, ',', '.');
            })
            ->addColumn('status', function ($query) {
                $badge = $query->status ? 'bg-success' : 'bg-danger';
                $text = $query->status ? 'Aktif' : 'Non-Aktif';
                return "<span class='badge {$badge}'>{$text}</span>";
            })
            ->editColumn('category_id', function ($query) {
                return $query->category->name ?? 'Tanpa Kategori';
            })
            ->setRowId('id')
            ->rawColumns(['action', 'image', 'status', 'price']);
    }

    public function query(Produk $model): QueryBuilder
    {
        $query = $model->newQuery()->with(['user', 'category']);

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('produk-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width(120)->addClass('text-center'),
            Column::make('id')->title('No')->render('meta.row + meta.settings._iDisplayStart + 1;'),
            Column::make('image')->title('Foto'),
            Column::make('title')->title('Nama Produk'),
            Column::make('category_id')->title('Kategori'),
            Column::make('price')->title('Harga'),
            Column::make('status')->title('Status'),
            Column::make('views')->title('Dilihat'),
        ];
    }
}
