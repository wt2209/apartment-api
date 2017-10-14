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
        return response()->json(['data' => $tree]);
    }

    public function rootNodes(Request $request)
    {
        return Navigation::where('parent_id', 0)->get();
    }

    public function insert(Request $request)
    {
        $nav = Navigation::create([
            'name'=> $request->get('name', ''),
            'display_name'=> $request->get('display_name', ''),
            'url'=> $request->get('url', ''),
            'icon'=> $request->get('icon', '1'),
            'parent_id'=> $request->get('parent_id', 0),
        ]);
        if ($nav) {
            return response()->json([]);
        } else {
            return response()->json(['error'=>'内部错误'], 500);
        }
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
