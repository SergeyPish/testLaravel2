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
            $query = $query->where('type_id', $request->get('type_id'));
        }

        if ($request->get('manufacturer_id') != null) {
            $query = $query->where('manufacturer_id', $request->get('manufacturer_id'));
        }

        return $query;
    }

}
