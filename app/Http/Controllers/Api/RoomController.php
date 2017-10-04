<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{

    public function roomStructure()
    {
        $ret = [
            [
                'label' => '大学生房间',
                'value'=>'',
                'children'=>[
                    [
                        'label'=>'红2',
                        'value'=>'',
                        'children'=>[
                            [
                                'label'=>'1单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'2单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'3单元',
                                'value'=>''
                            ],
                        ]
                    ],
                    [
                        'label'=>'红3',
                        'value'=>'',
                        'children'=>[
                            [
                                'label'=>'1单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'2单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'3单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'4单元',
                                'value'=>''
                            ],
                        ]
                    ],
                    [
                        'label'=>'7',
                        'value'=>'',
                        'children'=>[
                            [
                                'label'=>'1单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'2单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'3单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'4单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'5单元',
                                'value'=>''
                            ],
                        ]
                    ],
                ]
            ],
            [
                'label' => '职工房间',
                'value'=>'',
                'children'=>[
                    [
                        'label'=>'高2',
                        'value'=>'',
                        'children'=>[
                            [
                                'label'=>'1单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'2单元',
                                'value'=>''
                            ],
                            [
                                'label'=>'3单元',
                                'value'=>''
                            ],
                        ]
                    ]
                ]
            ],
        ];
        return response()->json($ret);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function rooms()
    {
        $rooms = [[
            'display_name'=>'7-1-101',
            'person_number'=>4,
            'building'=>7,
            'unit'=>1,
            'persons'=>[
                [
                    'name'=>'张三',
                    'gender'=>'男',
                ],
                [
                    'name'=>'李四',
                    'gender'=>'女',
                ],
            ],
        ]];
        return response()->json($rooms);
    }
}
