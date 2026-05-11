<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.order.action', compact('query'));
            })
            ->addColumn('customer', function ($query) {
                return "<strong>{$query->nama}</strong><br><small class='text-muted'>{$query->no_hp}</small>";
            })
            ->editColumn('status', function ($query) {
                $color = match ($query->status) {
                    'pending'    => 'warning',
                    'diproses'   => 'info',
                    'selesai'    => 'success',
                    'dibatalkan' => 'danger',
                    default      => 'secondary'
                };
                return "<span class='badge bg-{$color}'>" . ucfirst($query->status) . "</span>";
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d/m/Y H:i');
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status', 'customer']);
    }

    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(6)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100),
            Column::make('id')->title('No')->render('meta.row + meta.settings._iDisplayStart + 1;'),
            Column::make('customer')->title('Pelanggan'),
            Column::make('jenis_layanan')->title('Layanan'),
            Column::make('judul')->title('Judul Pesanan'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::make('created_at')->title('Tanggal Masuk'),
        ];
    }

    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
