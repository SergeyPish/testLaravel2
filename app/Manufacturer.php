<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'manufacturer';

    public function searchFilter($query, $request)
    {
        if ($request->get('type_id') != null) {

            $query = $query->from('manufacturer as man')->distinct()->leftJoin('beer', 'man.id', '=', 'beer.manufacturer_id')
                ->where('beer.type_id', $request->get('type_id'))
                ->select(['man.*']);
        }

        return $query;
    }
}
