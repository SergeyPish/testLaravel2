<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beer;
use App\Type;
use App\Manufacturer;
use Validator;


class BeerController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Пиво';

        $types = Type::all();

        $manufacturers = Manufacturer::all();

        $beers = new Beer;

        $beers = $beers->searchFilter(new Beer, $request)->get();

        if ($request->get('type_id') != null) {
            $type_id = $request->get('type_id');
        } else {
            $type_id = 0;
        }

        if ($request->get('manufacturer_id') != null) {
            $manufacturer_id = $request->get('manufacturer_id');
        } else {
            $manufacturer_id = 0;
        }

        return view('layouts.beer.beer', compact('data', 'beers', 'types', 'manufacturers', 'type_id', 'manufacturer_id'));
    }

    public function show($id, Request $request)
    {
        $data['title'] = 'Редактирвоание пива';

        $types = Type::all();

        $manufacturers = Manufacturer::all();

        if ($request->all() == null) {
            if ($id) {
                $action = route('beer.show.edit', ['id' => $id]);

                $beerInfo = Beer::findOrFail($id);

                if (!$beerInfo) {
                    throw new \Exception("Пиво не найдено");
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required',
                'type_id' => 'required',
                'manufacturer_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $type = Beer::findOrFail($request->input('id'));
                $type->name = $request->input('name');
                $type->description = $request->input('description');
                $type->type_id = $request->input('type_id');
                $type->manufacturer_id = $request->input('manufacturer_id');
                $type->save();

                return redirect()->route('beer.index');
            }
        }

        return view('layouts.beer.form', compact('data', 'beerInfo', 'action', 'types', 'manufacturers'));

    }

    public function add(Request $request)
    {
        $data['title'] = 'Добавление пива';

        $action = route('beer.add.write');

        $types = Type::all();

        $manufacturers = Manufacturer::all();

        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required',
                'type_id' => 'required',
                'manufacturer_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $type = new Beer;
                $type->name = $request->input('name');
                $type->description = $request->input('description');
                $type->type_id = $request->input('type_id');
                $type->manufacturer_id = $request->input('manufacturer_id');
                $type->save();

                return redirect()->route('beer.index');
            }
        }

        return view('layouts.beer.form', compact('data', 'action', 'types', 'manufacturers'));
    }

    public function delete($id, Request $request)
    {
        if ($id) {
            $type = Beer::findOrFail($id);

            if (!$type) {
                throw new \Exception("Производитель не найден");
            }

            $type->delete();

            return redirect()->back();
        }
    }
}
