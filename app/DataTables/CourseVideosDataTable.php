<?php

namespace App\DataTables;

use App\Models\CourseVideo;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseVideosDataTable extends DataTable
{
    protected $courseId;

    public function __construct($courseId = null)
    {
        $this->courseId = $courseId;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('thumbnail', function($query){
                return '<img src="' . $query->youtubeThumbnail . '" alt="' . $query->title . '" class="w-40 h-40 rounded-8 object-cover">';
            })
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
            Column::make('thumbnail')
                ->title('Thumbnail')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
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