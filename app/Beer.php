<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $table = 'beer';

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function searchFilter($query, $request)
    {
        if ($request->get('type_id') != null) {
            $queryType = $query->where('type_id', $request->get('type_id'));
        }

        if (isset($queryType)) {
            if ($request->get('manufacturer_id') != null) {
                $queryType = $queryType->where('manufacturer_id', $request->get('manufacturer_id'));
            }
        } else {
            if ($request->get('manufacturer_id') != null) {
                $queryType = $query->where('manufacturer_id', $request->get('manufacturer_id'));
            }
        }

        if (isset($queryType)) {
            return $queryType;
        } else {
            return $query;
        }
    }

}
