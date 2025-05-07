<?php

namespace App\DataTables;

use App\Models\CourseVideo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CourseVideosDataTable extends DataTable
{
    public $courseId;

    public function __construct($courseId = 0)
    {
        $this->courseId = $courseId;

        Log::info($this->courseId);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                return view('admin.videos.action', compact('query'))->render();
            })
            ->rawColumns(['thumbnail', 'action'])
            ->setRowId('id');
    }


    public function query(CourseVideo $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('course_id', $this->courseId)
            ->orderBy('order', 'asc');
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course-videos-table')
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


    protected function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('#')
                ->render('meta.row + meta.settings._iDisplayStart + 1'),
            Column::make('title')
                ->title('Judul Video')
                ->addClass('text-gray-300'),
            Column::make('duration')
                ->title('Durasi')
                ->addClass('text-gray-300 text-center'),
            Column::make('order')
                ->title('Urutan')
                ->addClass('text-gray-300 text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false),
        ];
    }


    protected function filename(): string
    {
        return 'CourseVideos_' . date('YmdHis');
    }
}