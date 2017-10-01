<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Navigation;

class NavigationController extends Controller
{
    public function navigations()
    {
        $navs = Navigation::get();
        $tree = $this->arrayToTree($navs->toArray());
        return response()->json($tree);
    }

    private function arrayToTree($items, $parentId = 0) {
        $tree = [];
        foreach ($items as $item) {
            if ($item['parent_id'] == $parentId) {
                $t = $item;
                $t['children'] = $this->arrayToTree($items, $t['id']);
                $tree[] = $t;
            }
        }
        return $tree;
    }
}
