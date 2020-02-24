<?php

use Illuminate\Support\Facades\Route;


if(!function_exists('display_column'))
{
    function display_column($column)
    {
        $params = [];
        $sort = request()->except('sort');
        $query = '';
  		$module = explode('.', Route::current()->getName())[0];
        $columnField = $column['name'];

        if (array_key_exists('sortable', $column)) {
            $sort['sort_field'] = $column['id'];
            $query = http_build_query($sort);

            $columnField = sprintf('<span class="flex item-center">
                      <span class="mr-1">%3$s</span>
                      <span>
                        <a href="%1$s%2$s%4$s%5$s">%6$s</a>
                        <a href="%1$s%2$s%4$s%7$s">%8$s</a>
                      </span>
                    </span>',
                    route($module.'.index'),
                    ($sort ? '?':'') . $query,
                    $column['name'],
                    ($sort ? '&':'?'),
                    'sort=asc',
                    config('table.default_sort_icons.asc_sort_icon'),
                    'sort=desc',
                    config('table.default_sort_icons.desc_sort_icon')
                );
        }

        return $columnField;
    }
}


if(!function_exists('status_icon'))
{
    function status_icon($status, $date)
    {
        if($status == \App\Http\Models\Status::DRAFT) {
            return '<i class="inline-block rounded-full w-3 h-3 mr-2 bg-gray-500"></i>';
        }

        if($status == \App\Http\Models\Status::PUBLISH) {

            if($date > time()) {
                return '<i class="inline-block rounded-full border-2 w-3 h-3 mr-2 border-blue-500"></i>';
            }

            return '<i class="inline-block rounded-full w-3 h-3 mr-2 bg-blue-500"></i>';
        }
    }
}
