<?php

namespace App\DataTables;

use App\Models\Especie;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EspecieDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Especie> $query Results from query() method.
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
            ->addColumn('action', function(Especie $especie){
                return '
                    <button class="btn btn-sm btn-dark edit-btn" onclick="editarEspecie('.$especie->id.')"   data-id="'.$especie->id.'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" onclick="borrarEspecie('.$especie->id.')" data-id="'.$especie->id.'">
                        <i class="bi bi-trash"></i>
                    </button>
                
                ';
            })
            ->addColumn('imagen', function (Especie $especie) {

                if ($especie->image_path) {
                    $url = asset('storage/' . $especie->image_path);

                return '<img
                        src="' . $url . '"
                        width="50" height="50"
                        style="cursor:pointer"
                        onclick="mostrarImagen(\'' . $url . '\')"
                    >';
                }

                return 'No tiene imagen cargada';
            })
            ->setRowAttr([
                'data-aos' => 'fade-up',   
                'data-aos-delay' => function ($row) {
                    return $row->id * 50 % 400;
                },
            ])
            ->rawColumns(['imagen', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Especie>
     */
    public function query(Especie $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('especie-table')
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
            Column::make('nombre')->title('Nombre'),
            Column::make('nombre_cientifico')->title('N. cientifico'),
            Column::computed('imagen')
                ->title('Imagen')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Especie_' . date('YmdHis');
    }
}
