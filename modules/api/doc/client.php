<?php
/**
 * 客户端api
 */

return [

    // ------------------------------------------------------------------------
    'ShopType' => [
        'url'    => '/api/client/shop/type',
        'desc'   => '获取商户平台行业以及行业标签',
        'method' => 'GET',
        'return' => '商品行业类别以及标签信息',
        'over'   => 1,
        'params' => [],
    ],

    // ------------------------------------------------------------------------
    'Shop' => [
        'url'    => '/api/client/shop',
        'desc'   => '根据医院附近指定行业的店铺的列表',
        'method' => 'GET',
        'return' => '商铺店铺列表, 数量',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'hos_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '医院id',
            ],
            [
                'field'   => 'shop_type_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '类型id',
            ],
            [
                'field'   => 'type_tag_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '标签ID',
            ],
            [
                'field'   => 'order_by',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '排序依据',
            ],
            [
                'field'   => 'order_dir',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '排序方向',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '第几页',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '数量',
            ],
            
        ],
    ],

    // ------------------------------------------------------------------------
    'ShopInfo' => [
        'url'    => '/api/client/shop/info',
        'desc'   => '店铺综合信息',
        'method' => 'GET',
        'return' => '店铺详情信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商户id',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'Goods' => [
        'url'    => '/api/client/goods',
        'desc'   => '店铺商品信息',
        'method' => 'GET',
        'return' => '商品列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'shop_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
            [
                'field'   => 'cate_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '页数',
            ],
        ],
    ],
    'GoodsDetail' => [
        'url'    => '/api/client/goods/detail',
        'desc'   => '商品信息',
        'method' => 'GET',
        'return' => '商品信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'shop_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'Comment' => [
        'url'    => '/api/client/comment/index',
        'desc'   => '店铺评论信息',
        'method' => 'GET',
        'return' => '评论列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'shop_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '页数',
            ],
        ],
    ],
    // ------------------------------------------------------------------------

    'SearchGoods' => [
        'url'    => '/api/client/search/goods',
        'desc'   => '搜索商品',
        'method' => 'GET',
        'return' => '商品列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'hos_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
            [
                'field'   => 'goods_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品名称',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '第几页',
            ],
        ],
    ],

    // ------------------------------------------------------------------------
    'OrderCreate' => [
        'url'    => '/api/client/order/create',
        'desc'   => '直接创建一个订单',
        'method' => 'POST',
        'return' => '相关订单信息',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'customer_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '客户ID',
            ],
            [
                'field'   => 'hos_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '医院ID',
            ],
            [
                'field'   => 'shop_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺ID',
            ],
            [
                'field'   => 'mobile',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '电话',
            ],
            [
                'field'   => 'contact_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '联系人名称',
            ],
            [
                'field'   => 'contact_address',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '联系人地址',
            ],
            [
                'field'   => 'notice',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '联系人地址',
            ],
            [
                'field'   => 'is_cod',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否事货到付款 1 是',
            ],
            [
                'field'   => 'goods_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品ID列表 12,2|13,4',
            ],
            [
                'field'   => 'dfa_price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '配送费',
            ],
        
        ],
    ],
    // ------------------------------------------------------------------------
    'OrderDel' => [
        'url'    => '/api/client/order/del',
        'desc'   => '删除订单',
        'method' => 'POST',
        'return' => '是否成功',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
            [
                'field'   => 'customer_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '客户id',
            ],

        ],
    ],
    // ------------------------------------------------------------------------
    'OrderList' => [
        'url'    => '/api/client/order/list',
        'desc'   => '用户订单列表',
        'method' => 'GET',
        'return' => '用户订单列表',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'customer_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '客户ID',
            ],
            [
                'field'   => 'pro_status',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单状态',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '页数',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'OrderDetail' => [
        'url'    => '/api/client/order/detail',
        'desc'   => '订单详情',
        'method' => 'GET',
        'return' => '订单详情',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单id',
            ]
        ],
    ],

    // ------------------------------------------------------------------------
    'OrderChangeStatus' => [
        'url'    => '/api/client/order/change-status',
        'desc'   => '更改订单状态',
        'method' => 'POST',
        'return' => '订单呢信息',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单id',
            ],
            [
                'field'   => 'pro_status',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单状态',
            ]
        ],
    ],

    // ------------------------------------------------------------------------
    'OrderCheckOrder' => [
        'url'    => '/api/client/order/check',
        'desc'   => '查看订单状态',
        'method' => 'GET',
        'return' => '订单信息',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单id',
            ]
        ],
    ],

    // ------------------------------------------------------------------------

    'CommentAdd' => [
        'url'    => '/api/client/comment/add',
        'desc'   => '对订单进行评论',
        'method' => 'POST',
        'return' => '评论自身',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'shop_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺id',
            ],
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '资源对象（ order_id）',
            ],
            [
                'field'   => 'customer_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '客户ID',
            ],
            [
                'field'   => 'content',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '评论内容',
            ],
            [
                'field'   => 'score',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '评分',
            ],
            [
                'field'   => 'goods_comment',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '对商品的评论和评分 [detail_id, comment, score|..]',
            ],

        
        ],
    ],



    // ------------------------------------------------------------------------
    'CommentDel' => [
        'url'    => '/api/client/comment/del',
        'desc'   => '删除一个评论',
        'method' => 'POST',
        'return' => '评论自身',
        'over'   => 0,
        'params' => [],
    ],
];
