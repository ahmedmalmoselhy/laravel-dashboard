<?php

use App\Bll\Constants;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Models\CountryData;

return [
    'baseModel' => Country::query(),
    'dataModel' => CountryData::query(),
    'allow_edit' => true,
    'base_route' => route('dashboard.country.index'),
    'route' => 'country',
    'title' => _i('Countries'),
    'createTitle' => _i('Create Country'),
    'editTitle' => _i('Edit Country'),
    'uploads' => Constants::CountryPath,
    'columns' => [
        [
            'name' => 'id',
            'type' => 'hidden',
            'model' => 'base',
            'label' => _i('ID'),
            'editable' => false,
            'searchable' => false,
            'sortable' => true,
            'showInForm' => true,
            'required' => true,
        ],
        [
            'name' => 'title',
            'type' => 'text',
            'model' => 'data',
            'label' => _i('Title'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'placeholder' => _i('Country Title'),
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'code',
            'type' => 'text',
            'model' => 'base',
            'label' => _i('Code'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'placeholder' => _i('Country Code'),
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'dialing_code',
            'type' => 'text',
            'model' => 'base',
            'label' => _i('Phone Code'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'placeholder' => _i('Country Phone Code'),
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'status',
            'type' => 'checkbox',
            'model' => 'base',
            'label' => _i('Status'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'lat',
            'type' => 'number',
            'model' => 'base',
            'label' => _i('Latitude'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'step' => 'any',
            'min' => -90,
            'max' => 90,
            'placeholder' => _i('Country Latitude'),
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'lng',
            'type' => 'number',
            'model' => 'base',
            'label' => _i('Longitude'),
            'editable' => true,
            'searchable' => true,
            'sortable' => true,
            'step' => 'any',
            'min' => -180,
            'max' => 180,
            'placeholder' => _i('Country Longitude'),
            'required' => true,
            'showInForm' => true,
        ],
        [
            'name' => 'created_at',
            'type' => 'text',
            'model' => 'base',
            'label' => _i('Created At'),
            'editable' => false,
            'searchable' => false,
            'sortable' => true,
            'showInForm' => false,
        ],
        [
            'name' => 'action',
            'type' => 'action',
            'model' => 'action',
            'label' => _i('Options'),
            'editable' => false,
            'searchable' => false,
            'sortable' => false,
            'data' => [
                'edit' => 'admin.components.buttons.edit',
                'delete' => 'admin.components.buttons.delete',
            ],
            'showInForm' => false,
        ]
    ],
    'validation' => [
        'rules' => [
            'title' => 'required|string|max:255|min:3',
            'code' => 'required|string|max:10|min:2|unique:countries,code',
            'dialing_code' => 'required|string|max:10|min:2|unique:countries,dialing_code',
            'lang_id' => 'required|integer',
        ],
        'messages' => [
            'title.required' => _i('Title is required'),
            'code.required' => _i('Code is required'),
            'code.unique' => _i('Code is already exists'),
            'dialing_code.required' => _i('Dialing code is required'),
            'dialing_code.unique' => _i('Dialing code is already exists'),
        ]
    ]
];