<?php

// Do exactly like this file to create global method
// Just change the method name
// The best practice is using underscore (_) as prefix the method name
// Best Practice Class Name Example: _sendEmail, _deleteData, ect.

use App\Models\BaseModel;
use App\Utils\Date\LocalCarbon;

if (!function_exists('filterData')) {
    function filterData($q, $data)
    {
        foreach ($data as $column => $operators) {
            $column = str_replace('->', '.', $column);
            // check is column exist
            foreach ($operators as $operator => $value) {
                try {
                    $value = LocalCarbon::createFromFormat('d-m-Y', $value);
                    $q->whereDate($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                } catch (Exception $e) {
                    if ($operator == 'is') {
                        if ($value == 'NULL') {
                            $q->whereNull($column);
                        } else {
                            $q->whereNotNull($column);
                        }
                    } else {
                        if (strpos($column, '.') !== false) {
                            if ($operator == 'l')
                                $q->whereRelation(explode('.', $column)[0], explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                            else
                                $q->whereRelation(explode('.', $column)[0], explode('.', $column)[1], optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                        } else {
                            if ($operator == 'l')
                                $q->where($column, optional(BaseModel::OPERATORS)[$operator], '%' . $value . '%');
                            else
                                $q->where($column, optional(BaseModel::OPERATORS)[$operator] ?? '=', $value);
                        }
                    }
                }
            }
        }
    }
}
