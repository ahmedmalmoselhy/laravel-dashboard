<?php

namespace App\Modules\Admin\Controllers;

use App\Bll\Lang;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class DashboardController extends Controller
{
    protected $columns = [];

    protected $model = null;
    protected $dataModel = null;

    public function __construct()
    {
    }

    protected function home(Request $request)
    {
        return view('admin.home');
    }

    protected function changeLanguage($language)
    {
        $lang = Language::query()
            ->findOrFail($language);

        session()->forget('admin_lang');

        session()->put('admin_lang', $lang);

        return redirect()->back();
    }

    protected function index(Request $request)
    {
    }

    protected function create(Request $request)
    {
    }

    protected function store(Request $request)
    {
        // filter column names from colums having model base
        $baseColums = [];
        foreach ($this->columns as $key => $column) {
            if (isset($column['model']) && $column['model'] == 'base') {
                $baseColums[$key] = $column;
            }
        }
        $newBase = $this->model->create($request->only($baseColums));

        // get column names from colums having model data
        $dataColums = ['master_id' => $newBase->id];
        foreach ($this->columns as $key => $column) {
            if ($column['model'] == 'data') {
                $dataColums[] = $key;
            }
        }

        $newData = $this->dataModel->create($request->only($dataColums));

        return redirect()->back()->with('success', _i('New record created successfully'));
    }

    protected function show(Request $request)
    {
        $item = $this->model->with([
            'AdminTranslated'
        ])->findOrFail($request->input('id'));
    }

    protected function edit(Request $request)
    {
    }

    protected function update(Request $request)
    {
        $item = $this->model->findOrFail($request->input('id'));

        // filter column names from colums having model base
        $baseColums = [];
        foreach ($this->columns as $key => $column) {
            if (isset($column['model']) && $column['model'] == 'base') {
                $baseColums[$key] = $column;
            }
        }
        $item->update($request->only($baseColums));

        // get column names from colums having model data
        $dataColums = [];
        foreach ($this->columns as $key => $column) {
            if ($column['model'] == 'data') {
                $dataColums[] = $key;
            }
        }
        $this->dataModel->where([
            'master_id' => $item->id,
            'lang_id' => Lang::getAdminLangId()
        ])->update($request->only($dataColums));

        return redirect()->back()->with('success', _i('Record updated successfully'));
    }

    protected function destroy(Request $request)
    {
        $statusCode = 200;
        $response = [
            'message' => _i('Deleted Successfully'),
            'fail' => false,
        ];
        try {
            $this->model->where('id', $request->get('id'))->delete();
        } catch (\Exception $e) {
            $statusCode = 500;
            $response = [
                'message' => _i('Error Deleting'),
                'fail' => true,
            ];
        }

        return response()->json($response, $statusCode);
    }

    protected function restore(Request $request)
    {
        $statusCode = 200;
        $response = [
            'message' => _i('Restored Successfully'),
            'fail' => false,
        ];
        try {
            $this->model->where('id', $request->get('id'))->restore();
        } catch (\Exception $e) {
            $statusCode = 500;
            $response = [
                'message' => _i('Error Restoring'),
                'fail' => true,
            ];
        }

        return response()->json($response, $statusCode);
    }

    protected function forceDelete(Request $request)
    {
        $statusCode = 200;
        $response = [
            'message' => _i('Deleted Successfully'),
            'fail' => false,
        ];
        try {
            $this->model->where('id', $request->get('id'))->forceDelete();
        } catch (\Exception $e) {
            $statusCode = 500;
            $response = [
                'message' => _i('Error Deleting'),
                'fail' => true,
            ];
        }

        return response()->json($response, $statusCode);
    }

    protected function getTranslation(Request $request)
    {
        $lang = $request->input('lang');
        $id = $request->input('id');

        $data = $this->dataModel->where('master_id', $id)
            ->where('lang_id', $lang)
            ->first();

        return response()->json([
            'data' => $data,
        ]);
    }

    protected function setTranslation(Request $request)
    {
        $lang = $request->input('lang');
        $id = $request->input('id');

        $data = $this->dataModel->where('master_id', $id)
            ->where('lang_id', $lang)
            ->first();

        if ($data) {
            $data->update($request->all());
        } else {
            $this->dataModel->create($request->all());
        }

        return response()->json(['message' => _i('Translation saved successfully')]);
    }
}
