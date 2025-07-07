<?php

namespace App\DataTables;

use App\Models\Raza;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RazaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Raza> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function($row){
                return $row->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function($row){
                return $row->updated_at->format('d/m/Y H:i');
            })
            ->editColumn('especie', function(Raza $row){
                return optional($row->especie)->nombre ?? '';
            })
            ->addColumn('action', function(Raza $razas){
                return'
                    <button class="btn btn-sm btn-dark edit-btn" onclick="editarRaza('.$razas->id.')"   data-id="'.$razas->id.'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" onclick="borrarRaza('.$razas->id.')" data-id="'.$razas->id.'">
                        <i class="bi bi-trash"></i>
                    </button>
                ';
            })
            ->setRowAttr([
                'data-aos' => 'fade-up',   
                'data-aos-delay' => function ($row) {
                    return $row->id * 50 % 400;
                },
            ])
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Raza>
     */
    public function query(Raza $model): QueryBuilder
    {
        return $model->newQuery()
            ->with('especie');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('raza-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bftrip')
                    ->orderBy(1)
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
            Column::make('nombre'),
            Column::computed( 'especie')
                ->title('Especie')
                ->exportable(true)
                ->printable(true)
                ->orderable(false)
                ->searchable(false),
            Column::make('rasgos'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Raza_' . date('YmdHis');
    }
}
