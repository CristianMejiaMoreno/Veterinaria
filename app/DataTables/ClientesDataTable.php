<?php

namespace App\DataTables;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClientesDataTable extends DataTable
{
    /**
     * Arma el DataTable y añade la columna de acciones
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y H:i');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d/m/Y H:i');
            })
            ->addColumn('action', function (Cliente $cliente) {
          
                return '
                    <button class="btn btn-sm btn-dark edit-btn" onclick="editarCliente('.$cliente->id.')"   data-id="'.$cliente->id.'">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" onclick="borrarCliente('.$cliente->id.')" data-id="'.$cliente->id.'">
                        <i class="bi bi-trash"></i>
                    </button>
                ';
            })
            ->setRowAttr([
                'data-aos'       => 'fade-up',   
                'data-aos-delay' => function ($row) {
                    return $row->id * 50 % 400;
                },
            ])
            ->rawColumns(['action'])   // indica que la columna contiene HTML
            ->setRowId('id');
    }

    /**
     * Consulta base
     */
    public function query(Cliente $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Configuración del HTML builder (incluye columna action y botones exportar)
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('clientes-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
                Button::make('reload'),
            ]);
    }

    /**
     * Columnas básicas
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('#'),
            Column::make('nombre')->title('Nombre'),
            Column::make('email')->title('Email'),
            Column::make('telefono')->title('Teléfono'),
            Column::make('direccion')->title('Dirección'),
            Column::make('created_at')->title('Creado'),
            Column::make('updated_at')->title('Actualizado'),
            // La columna Acciones la agrega addAction()
        ];
    }

    /**
     * Nombre de archivo para exportaciones
     */
    protected function filename(): string
    {
        return 'Clientes_' . date('YmdHis');
    }
}
