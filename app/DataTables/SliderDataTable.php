<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.slider.action', compact('query'));
            })
            ->addColumn('image', function ($query) {
                return "<img src='" . asset('storage/assets/back/img/slider/' . $query->image) . "' 
                        style='width:80px;height:50px;object-fit:cover;border-radius:4px;'>";
            })
            ->addColumn('status', function ($query) {
                $badgeClass = $query->status == 1 ? 'bg-success' : 'bg-danger';
                $statusText = $query->status == 1 ? 'Aktif' : 'Tidak Aktif';
                return "<span class='badge {$badgeClass}'>{$statusText}</span>";
            })
            ->addColumn('created_at', function ($query) {
                return $query->created_at->format('d-m-Y');
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status', 'image']);
    }

    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120),
            Column::make('id')->title('No')->render('meta.row + meta.settings._iDisplayStart + 1;'),
            Column::make('image')->title('Gambar'),
            Column::make('title')->title('Judul'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Dibuat'),
        ];
    }

    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
