<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer;
use App\Type;
use Validator;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Производители';

        $types = Type::all();

        if ($request->get('type_id') != null) {
            $type_id = $request->get('type_id');
        } else {
            $type_id = 0;
        }


        //$manufacturers = Manufacturer::all();

        $manufacturers = new Manufacturer;

        $manufacturers = $manufacturers->searchFilter(new Manufacturer, $request)->get();

        return view('layouts.manufacturer.manufacturer', compact('data', 'manufacturers', 'types', 'type_id'));
    }

    public function show($id, Request $request)
    {
        $data['title'] = 'Редактирвоание производителя';

        if ($request->all() == null) {
            if ($id) {
                $action = route('brand.show.edit', ['id' => $id]);

                $manInfo = Manufacturer::findOrFail($id);

                if (!$manInfo) {
                    throw new \Exception("Производитель не найден");
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $type = Manufacturer::findOrFail($request->input('id'));
                $type->name = $request->input('name');
                $type->save();

                return redirect()->route('brand.index');
            }
        }

        return view('layouts.manufacturer.form', compact('data', 'manInfo', 'action'));

    }

    public function add(Request $request)
    {
        $data['title'] = 'Добавление производителя';

        $action = route('brand.add.write');

        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $type = new Manufacturer;
                $type->name = $request->input('name');
                $type->save();

                return redirect()->route('brand.index');
            }
        }

        return view('layouts.manufacturer.form', compact('data', 'action'));
    }

    public function delete($id, Request $request)
    {
        if ($id) {
            $type = Manufacturer::findOrFail($id);

            if (!$type) {
                throw new \Exception("Производитель не найден");
            }

            $type->delete();

            return redirect()->back();
        }
    }
}
