<?php

// Do exactly like this file to create global method
// Just change the method name
// The best practice is using underscore (_) as prefix the method name
// Best Practice Class Name Example: _sendEmail, _deleteData, ect.

use App\Models\BaseModel;
use App\Utils\Date\LocalCarbon;
use Illuminate\Support\Facades\Schema;

if (!function_exists('filterData')) {
    function filterData($q, $data)
    {
        foreach ($data as $column => $operators) {
            if (gettype($operators) == 'array') {
                $column = str_replace('->', '.', $column);
                // check is column exist
                foreach ($operators as $operator => $value) {
                    if ($value != '') {
                        try {
                            $value = LocalCarbon::createFromFormat('d-m-Y', $value);
                            if (strpos($column, '.') !== false) {
                                if (count(explode('.', $column)) > 2) {
                                    $relation = '';
                                    $serachColumn = '';
                                    $relation_arr = [];
                                    foreach (explode('.', $column) as $k => $single_column) {
                                        if ($k == (count(explode('.', $column)) - 1)) {
                                            $serachColumn = $single_column;
                                            break;
                                        }
                                        $relation .= $single_column;
                                        $relation_arr[] = $single_column;
                                        if ($k != (count(explode('.', $column)) - 2))
                                            $relation .= '.';
                                    }

                                    $relationModel = get_class($q->getModel());
                                    $relationModel = new $relationModel;
                                    foreach ($relation_arr as $r) {
                                        $relationModel = get_class($relationModel->$r()->getModel());
                                        $relationModel = new $relationModel;
                                    }
                                    // if (Schema::hasColumn($relationModel->getTable(), $serachColumn))
                                    $q->whereHas($relation, function ($r) use ($serachColumn, $operator, $value) {
                                        $r->whereDate($serachColumn, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                    });
                                } else {
                                    $relation = explode('.', $column)[0];
                                    $relationModel = get_class($q->getModel());
                                    $relationModel = new $relationModel;
                                    // if (Schema::hasColumn($relationModel->$relation()->getModel()->getTable(), explode('.', $column)[1]))
                                    $q->whereHas(explode('.', $column)[0], function ($r) use ($column, $operator, $value) {
                                        $r->whereDate(explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                    });
                                }
                            } else {
                                if (Schema::hasColumn($q->getModel()->getTable(), $column))
                                    $q->whereDate($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                            }
                        } catch (Exception $e) {
                            if ($operator == 'is') {
                                if (Schema::hasColumn($q->getModel()->getTable(), $column))
                                    if ($value == 'NULL') {
                                        $q->whereNull($column);
                                    } else {
                                        $q->whereNotNull($column);
                                    }
                            } else {
                                if ($value !== false) {
                                    if (strpos($column, '.') !== false) {
                                        $relation = explode('.', $column)[0];
                                        $relationModel = get_class($q->getModel());
                                        $relationModel = new $relationModel;
                                        $relation_name = '';

                                        foreach (explode('.', $column) as $k => $c) {
                                            if ($k != count(explode('.', $column)) - 1) {
                                                $relation_name .= $c;
                                                $relation_name .= '.';
                                            }
                                        }
                                        $relation_name = substr($relation_name, 0, -1);
                                        // if (Schema::hasColumn($relationModel->$relation()->getModel()->getTable(), explode('.', $column)[1]))
                                        if ($operator == 'l') {
                                            $q->whereRelation($relation_name, explode('.', $column)[count(explode('.', $column)) - 1], optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                                        } else {
                                            $q->whereRelation($relation_name, explode('.', $column)[count(explode('.', $column)) - 1], optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                        }
                                    } else {
                                        // if (Schema::hasColumn($q->getModel()->getTable(), $column))
                                        if ($operator == 'l')
                                            $q->where($column, optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                                        else {
                                            $q->where($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
