<?php

namespace App\DataTables;

use App\Models\Mascotas;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MascotasDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Mascotas> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('dueño', function (Mascotas $row){
                return optional($row->cliente)->nombre ?? '-';
            })
            ->editColumn('created_at', function($row){
                return $row->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function($row){
                return $row->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function(Mascotas $mascotas){

                return '
                    <button class="btn btn-sm btn-dark edit-btn" onclick=""   data-id="'.$mascotas->id.'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" onclick="" data-id="'.$mascotas->id.'">
                        <i class="bi bi-trash"></i>
                    </button>
                ';

            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Mascotas>
     */
    public function query(Mascotas $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('cliente');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('mascotas-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->dom('Bftrip')
                    ->selectStyleSingle()
                    ->addAction([
                        'title'      => 'Acciones',
                        'width'      => '90px',
                        'className'  => 'text-center',
                        'exportable' => false,
                        'printable'  => false,
                        'orderable'  => false,
                        'searchable' => false,
                    ])
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed( 'dueño')
                ->title('Dueño')
                ->exportable(true)
                ->printable(true)
                ->orderable(false)
                ->searchable(false),
            Column::make('nombre'),
            Column::make('especie'),
            Column::make('raza'),
            Column::make('fecha_nacimiento'),
            Column::make('sexo'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Mascotas_' . date('YmdHis');
    }
}
