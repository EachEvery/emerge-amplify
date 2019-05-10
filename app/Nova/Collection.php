<?php

namespace App\Nova;

use Illuminate\Http\Request;
use App\Models\Collection as Model;
use Laravel\Nova\Fields\Text as TextField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Avatar;

class Collection extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Model::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
         'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Avatar::make('Photo', 'photo')->disk('s3'),
            TextField::make('Title'),
            TextField::make('Subtitle'),
            TextField::make('Portal Subdomain', 'portal')->hideFromIndex()->help('If this field is filled in, this collection & poems created from it will only be accessable from a custom subdomain.'),
            Boolean::make('Is Portal')->onlyOnIndex(),
            BelongsToMany::make('Texts'),
            HasMany::make('Poems'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
