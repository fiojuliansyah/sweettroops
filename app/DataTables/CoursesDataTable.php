<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('thumbnail', function($query){
                $thumbnails = json_decode($query->thumbnail, true);
                $thumbnail = isset($thumbnails[0]) ? $thumbnails[0] : 'default-thumbnail.jpg';
                return '<img src="' . asset('storage/' . $thumbnail) . '" alt="' . $query->title . '" class="w-40 h-40 rounded-8 object-cover">';
            })
            ->addColumn('action', function($query){
                return view('admin.courses.action', compact('query'))->render();
            })
            ->rawColumns(['thumbnail', 'action'])
            ->setRowId('id');
    }
    

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('courses-table')
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
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('#')
                ->render('meta.row + meta.settings._iDisplayStart + 1'),
            Column::make('thumbnail')
                ->title('Thumbnail')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
            Column::make('title')
                ->title('Title')
                ->addClass('text-gray-300'),
            Column::make('slug')
                ->title('Slug')
                ->addClass('text-gray-300'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Courses_' . date('YmdHis');
    }
}
