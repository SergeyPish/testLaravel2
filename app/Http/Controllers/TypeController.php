<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\BaseException;
use Validator;
use App\Type;

class TypeController extends Controller
{
    public function index()
    {
        $data['title'] = 'Типы пива';

        $types = Type::all();

        return view('layouts.type.type', compact('data', 'types'));
    }

    public function show($id, Request $request)
    {
        $data['title'] = 'Редактирвоание типа пива';

        if ($request->all() == null) {
            if ($id) {
                $action = route('type.show.edit', ['id' => $id]);

                $typeInfo = Type::findOrFail($id);

                if (!$typeInfo) {
                    throw new \Exception("Тип пива не найден");
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
                $type = Type::findOrFail($request->input('id'));
                $type->name = $request->input('name');
                $type->save();

                return redirect()->route('type.index');
            }
        }

        return view('layouts.type.form', compact('data', 'typeInfo', 'action'));

    }

    public function add(Request $request)
    {
        $data['title'] = 'Добавление типа пива';

        $action = route('type.add.write');

        if ($request->all()) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $type = new Type;
                $type->name = $request->input('name');
                $type->save();

                return redirect()->route('type.index');
            }
        }

        return view('layouts.type.form', compact('data', 'action'));
    }

    public function delete($id, Request $request)
    {
        if ($id) {
            $type = Type::findOrFail($id);

            if (!$type) {
                throw new \Exception("Тип пива не найден");
            }

            $type->delete();

            return redirect()->back();
        }
    }
}
