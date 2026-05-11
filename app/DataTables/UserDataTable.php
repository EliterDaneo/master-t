<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return view('admin.user.action', compact('query'));
            })
            ->addColumn('avatar', function ($query) {
                $src = $query->avatar
                    ? asset('storage/assets/back/img/avatar/' . $query->avatar)
                    : asset('assets/back/img/avatar/avatar-1.png');
                return "<img src='{$src}' style='width:40px;height:40px;object-fit:cover;border-radius:50%;'>";
            })
            ->addColumn('role', function ($query) {
                $map = [
                    'admin'  => 'bg-danger',
                    'writer' => 'bg-warning',
                    'user'   => 'bg-primary',
                ];
                $class = $map[$query->role] ?? 'bg-secondary';
                return "<span class='badge {$class}'>{$query->role}</span>";
            })
            ->addColumn('status', function ($query) {
                $verified = $query->email_verified_at ? true : false;
                $class    = $verified ? 'bg-success' : 'bg-secondary';
                $text     = $verified ? 'Terverifikasi' : 'Belum Verifikasi';
                return "<span class='badge {$class}'>{$text}</span>";
            })
            ->addColumn('created_at', function ($query) {
                return $query->created_at->format('d-m-Y');
            })
            ->setRowId('id')
            ->rawColumns(['action', 'avatar', 'role', 'status']);
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
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
            Column::make('avatar')->title('Avatar'),
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Email'),
            Column::make('role')->title('Role'),
            Column::make('phone')->title('Telepon'),
            Column::make('asal_sekolah')->title('Asal Sekolah'),
            Column::make('status')->title('Status'),
            Column::make('created_at')->title('Dibuat'),
        ];
    }

    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
