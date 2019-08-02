<?php

use Illuminate\Support\Str;

function generateFileName($title, $file)
{
	return Str::limit(Str::slug($title), 50, '').'-'.strtotime('now').'.'.$file->getClientOriginalExtension();
}

function removeFile($path)
{
	if (file_exists($path)) {
        unlink($path);
	}
}

/**
 * [activeLink description]
 * @param  [type] $route  [description]
 * @param  string $output [description]
 * @return [type]         [description]
 */
function activeLink($route, $resource = true, $output = 'active')
{
    $listResource = ['index', 'create', 'store', 'edit', 'update', 'show', 'destroy'];

    if (is_array($route)) {
        foreach ($route as $r) {
            if ($resource) {
                foreach ($listResource as $list) {
                    if (Route::current()->getName() == $r.'.'.$list) return $output;
                }
            }else{
                if (Route::current()->getName() == $r) return $output;
            }
        }
    }else{
        if ($resource) {
            foreach ($listResource as $list) {
                if (Route::current()->getName() == $route.'.'.$list) return $output;
            }
        }else{
            if (Route::current()->getName() == $route) return $output;
        }
    }

}