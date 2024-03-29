<?php

namespace Corals\Utility\Category\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Utility\Category\Models\Attribute;
use Corals\Utility\Category\Transformers\AttributeTransformer;
use Yajra\DataTables\EloquentDataTable;

class AttributesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('utility-category.models.attribute.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new AttributeTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Attribute $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Attribute $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'label' => ['title' => trans('utility-category::attributes.attributes.label')],
            'type' => ['title' => trans('utility-category::attributes.attributes.type')],
            'required' => ['title' => trans('utility-category::attributes.attributes.required')],
            'use_as_filter' => ['title' => trans('utility-category::attributes.attributes.use_as_filter')],
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }

    protected function getBulkActions()
    {
        return [
            'delete' => ['title' => trans('Corals::labels.delete'), 'permission' => 'Utility::attribute.delete', 'confirmation' => trans('Corals::labels.confirmation.title')],
        ];
    }

    protected function getOptions()
    {
        $url = url(config('utility-category.models.attribute.resource_url'));

        return ['resource_url' => $url];
    }
}
