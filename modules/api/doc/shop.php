<?php
/**
 * 商户端api
 */
return [
    // ------------------------------------------------------------------------
    'AppVersion' => [
        'url'    => '/api/app/version',
        'desc'   => '获取最新版本信息',
        'method' => 'GET',
        'return' => 'status = 1 已经是最新 status = 0 不是最新的 appInfo = app信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'version_code',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '版本号',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'AppFeedbackAdd' => [
        'url'    => '/api/app/feedback/add',
        'desc'   => '添加反馈信息',
        'method' => 'POST',
        'return' => '是否成功 success 1, 0',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
            [
                'field'   => 'email',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '邮件地址',
            ],
            [
                'field'   => 'content',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '反馈内容',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'AppTest' => [
        'url'    => '/api/app/debug/test',
        'desc'   => '测试',
        'method' => 'GET',
        'return' => '内容返回',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'arg',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '参数',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'AppDevice' => [
        'url'    => '/api/app/device',
        'desc'   => 'APP安装时候上传基本信息',
        'method' => 'POST',
        'return' => '是否成功 success = 1',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'app_type',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'app类型[ shop | client ]',
            ],
            [
                'field'   => 'device_type',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '设备类型[ android | ios ]',
            ],
            [
                'field'   => 'mac_address',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'mac地址',
            ],
            [
                'field'   => 'channel_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '推送ID',
            ],
            [
                'field'   => 'device_desc',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '设备描述字符串',
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'AppDebug' => [
        'url'    => '/api/app/debug',
        'desc'   => 'APP崩溃信息记录',
        'method' => 'POST',
        'return' => '是否成功',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'mobile_type',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '手机型号'
            ],
            [
                'field'   => 'mac_address',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'MAC地址'
            ],
            [
                'field'   => 'crash_at',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '崩溃时间'
            ],
            [
                'field'   => 'crash_info',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '崩溃信息'
            ],
            [
                'field'   => 'notice',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '附加消息'
            ],
            [
                'field'   => 'version_code',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '版本号'
            ],
            [
                'field'   => 'version_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '版本名称'
            ],
        ],
    ],
    // ------------------------------------------------------------------------
    'ShopType' => [
        'url'    => '/api/shop/type/entry',
        'desc'   => '获取有效店铺类型',
        'method' => 'GET',
        'return' => '店铺类型列表',
        'over'   => 1,
        'params' => [],
    ],

    // ------------------------------------------------------------------------
    'YzHospitalEntry' => [
        'url'    => '/api/yz/hospital/entry',
        'desc'   => '获取医院列表',
        'method' => 'GET',
        'return' => '医院列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'longitude',
                'default' => '',
                'type'    => 'text',
                'desc'    => '经度'
            ],
            [
                'field'   => 'latitude',
                'default' => '',
                'type'    => 'text',
                'desc'    => '纬度'
            ],
        ],
    ],

    // ------------------------------------------------------------------------
    'AuthUserCheckMobile' => [
        'url'    => '/api/auth/user/check-mobile',
        'desc'   => '验证一个手机号码是否已经注册',
        'method' => 'get',
        'return' => 'exist = 1- 存在 0 - 不存在',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'mobile',
                'default' => '',
                'type'    => 'text',
                'desc'    => '手机号码'
            ],
        ],
    ],

    // ------------------------------------------------------------------------
    'AuthUserValidCode' => [
        'url'    => '/api/auth/user/valid-code',
        'desc'   => '获取手机登陆验证码',
        'method' => 'get',
        'return' => '1 是否成功 2 再次申请的时间间隔',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'mobile',
                'default' => '',
                'type'    => 'text',
                'desc'    => '手机号码'
            ],
        ],
    ],

    // ------------------------------------------------------------------------
    'AuthUserRegister' => [
        'url'    => '/api/auth/user/register',
        'desc'   => '用户注册',
        'method' => 'get',
        'return' => '1 是否成功 2 注册后的用户信息',
        'over'   => 1,
        'token'  => 0,
        'validCode' => 1,
        'params' => [
            [
                'field'   => 'mobile',
                'default' => '',
                'type'    => 'text',
                'desc'    => '手机号码'
            ],
            [
                'field'   => 'valid_code',
                'default' => '',
                'type'    => 'text',
                'desc'    => '验证码'
            ],
            [
                'field'   => 'shop_type_id',
                'default' => '',
                'type'    => 'text',
                'desc'    => '商铺类型ID'
            ],
            [
                'field'   => 'hospital_ids',
                'default' => '',
                'type'    => 'text',
                'desc'    => '相关医院ID - "1,2,3"'
            ],
            [
                'field'   => 'tag_ids',
                'default' => '',
                'type'    => 'text',
                'desc'    => '选择标签"'
            ],
            [
                'field'   => 'channel_id',
                'default' => '',
                'type'    => 'text',
                'desc'    => '短息推送ID',
            ],
        ],
    ],


    // ------------------------------------------------------------------------
    'AuthUserLogin' => [
        'url'    => '/api/auth/user/login',
        'desc'   => '用户登陆',
        'method' => 'POST',
        'return' => '返回1.用户基本信息 2. TOKEN 3. token过期时间',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'mobile',
                'default' => '',
                'type'    => 'text',
                'desc'    => '手机号码'
            ],
            [
                'field'   => 'valid_code',
                'default' => '',
                'type'    => 'text',
                'desc'    => '验证码',
            ],
            [
                'field'   => 'channel_id',
                'default' => '',
                'type'    => 'text',
                'desc'    => '短息推送ID',
            ],
        ],
    ],

    //--------------------------------------------------------------------------
    'AuthUserInfo' => [
        'url'    => '/api/auth/user/info',
        'desc'   => '使用token获取用户信息',
        'method' => 'GET',
        'return' => '返回用户信息数组',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
        ],
    ],



    // ------------------------------------------------------------------------
    'AuthUserLogout' => [
        'url'    => '/api/auth/user/logout',
        'desc'   => '用户退出登陆',
        'method' => 'POST',
        'return' => '1. 时候成功 1 成功 0 失败',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
        ],
    ],

    'ShopInfoInit' => [
        'url'    => '/api/shop/info/init',
        'desc'   => '获取商铺初始化所需数据的集合',
        'method' => 'GET',
        'return' => '1 医院信息 2 店铺类型信息 3 店铺类型相关标签',
        'over'   => 1,
        'token'  => 1,
        'params' => [
            [
                'field'   => 'longitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '经度',
            ],
            [
                'field'   => 'latitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '纬度',
            ],
        ],
    ],


    'ShopInfo' => [
        'url'    => '/api/shop/info',
        'desc'   => '获取一个用户的店铺信息',
        'method' => 'GET',
        'return' => 'shopInfo:店铺信息 hospitalInfo:相关医院信息',
        'over'   => 1,
        'token'  => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
        ],
    ],

    'ShopInfoExist' => [
        'url'    => '/api/shop/info/exist',
        'desc'   => '测试一个账户是否已有店铺',
        'method' => 'GET',
        'return' => 'exist 1 存在 0 不存在',
        'over'   => 1,
        'token'  => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
        ],
    ],

    /*
    'ShopInfoAdd' => [
        'url'    => '/api/shop/info/add',
        'desc'   => '添加店铺信息(仅一个)',
        'method' => 'POST',
        'return' => 'shopInfo:店铺信息 hospitalInfo:相关医院信息',
        'over'   => 1,
        'token'  => 1,

        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
            [
                'field'   => 'shop_type_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺类型',
            ],

            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺名称',
            ],

            [
                'field'   => 'allow_price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '起送价格',
            ],

            [
                'field'   => 'longitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '精度',
            ],
            [
                'field'   => 'latitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '纬度',
            ],

            [
                'field'   => 'start_time',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '营业开始时间',
            ],
            [
                'field'   => 'end_time',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '营业结束时间',
            ],
            [
                'field'   => 'is_cod',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '货到付款',
            ],
            [
                'field'   => 'dfa_price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '送货费',
            ],
            [
                'field'   => 'msg_push',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否消息推送',
            ],
            [
                'field'   => 'msg_shake',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否震动通知',
            ],
            [
                'field'   => 'hos_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '相关医院',
            ],
            [
                'field'   => 'tag_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '行业标签',
            ],
        ],

    ],*/

    'ShopInfoEdit' => [
        'url'    => '/api/shop/info/edit',
        'desc'   => '编辑\添加店铺信息',
        'method' => 'POST',
        'return' => 'shopInfo:店铺信息 hospitalInfo:相关医院信息 tag信息 相册',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'TOKEN',
            ],
            [
                'field'   => 'shop_type_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺类型',
            ],

            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺名称',
            ],

            [
                'field'   => 'allow_price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '起送价格',
            ],

            [
                'field'   => 'longitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '精度',
            ],
            [
                'field'   => 'latitude',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '纬度',
            ],

            [
                'field'   => 'start_time',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '营业开始时间',
            ],
            [
                'field'   => 'end_time',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '营业结束时间',
            ],
            [
                'field'   => 'board',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '公告',
            ],
            [
                'field'   => 'is_cod',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '货到付款',
            ],
            [
                'field'   => 'user_status',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺状态',
            ],
            [
                'field'   => 'dfa_price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '配送费',
            ],
            [
                'field'   => 'msg_push',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否消息推送',
            ],
            [
                'field'   => 'msg_shake',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否震动通知',
            ],
            [
                'field'   => 'address',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商铺地址',
            ],
            [
                'field'   => 'hos_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '当前与医院的关联',
            ],
            [
                'field'   => 'tag_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '当前与标签的关联',
            ],
            [
                'field'   => 'photo_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '已有照片ID列表',
            ],
        ],
    ],
//-----------------------------------------------------------------------------
    'ShopInfoTags' => [
        'url'    => '/api/shop/info/tags',
        'desc'   => '获取商铺可用标签',
        'method' => 'GET',
        'return' => '标签列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'ShopCateAdd' => [
        'url'    => '/api/shop/cate/add',
        'desc'   => '添加商品分类',
        'method' => 'POST',
        'return' => '是否成功',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类名称',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'ShopCateEdit' => [
        'url'    => '/api/shop/cate/edit',
        'desc'   => '编辑商品分类',
        'method' => 'POST',
        'return' => '是否成功',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类名称',
            ],
            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类名称',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'ShopCateDel' => [
        'url'    => '/api/shop/cate/del',
        'desc'   => '删除产品分类',
        'method' => 'POST',
        'return' => '是否成功',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类名称',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'ShopCateAll' => [
        'url'    => '/api/shop/cate/all',
        'desc'   => '获取一个店铺的所有分类信息',
        'method' => 'GET',
        'return' => '返回店铺分类信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
        ],
    ],

    'ShopCateGoodsAmount' => [
        'url'    => '/api/shop/cate/goods-amount',
        'desc'   => '获取一个指定分类的商品数量',
        'method' => 'GET',
        'return' => '返回店铺分类信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'cate_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类ID',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'ShopGoodsAdd' => [
        'url'    => '/api/shop/goods/add',
        'desc'   => '添加商品信息',
        'method' => 'GET',
        'return' => '返回该商品完整信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'cate_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类ID',
            ],
            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品名称',
            ],
            [
                'field'   => 'norms',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '规格',
            ],
            [
                'field'   => 'unit_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '单位',
            ],
            [
                'field'   => 'des',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '描述',
            ],
            [
                'field'   => 'type_tag_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '标签',
            ],
            [
                'field'   => 'is_published',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否发布',
            ],
            [
                'field'   => 'price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '价格',
            ],
        ],
    ],

    //-------------------------------------------------------------------------
    
    'ShopGoodsEdit' => [
        'url'    => '/api/shop/goods/edit',
        'desc'   => '获取一个指定分类的商品列表',
        'method' => 'POST',
        'return' => '返回商品信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品ID',
            ],
            [
                'field'   => 'cate_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '分类ID',
            ],
            [
                'field'   => 'name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品名称',
            ],
            [
                'field'   => 'norms',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '规格',
            ],
            [
                'field'   => 'unit_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '单位',
            ],
            [
                'field'   => 'des',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '描述',
            ],
            [
                'field'   => 'type_tag_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '标签',
            ],
            [
                'field'   => 'is_published',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '是否发布',
            ],
            [
                'field'   => 'price',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '价格',
            ],
            [
                'field'   => 'photo_ids',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '已有照片ID列表',
            ],
        ],
    ],

    'ShopGoodsDel' => [
        'url'    => '/api/shop/goods/del',
        'desc'   => '删除一个指定商品',
        'method' => 'GET',
        'return' => '返回是否成功',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品ID',
            ],
        ],
    ],

    'ShopGoods' => [
        'url'    => '/api/shop/goods/detail',
        'desc'   => '获取一个商品的信息',
        'method' => 'GET',
        'return' => '商品信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品ID',
            ],
        ],
    ],

    'ShopGoodsPage' => [
        'url'    => '/api/shop/goods/page',
        'desc'   => '商品管理页面初始化',
        'method' => 'GET',
        'return' => '树状商品信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
        ]
    ],

    'ShopGoodsAll' => 
    [
        'url'    => '/api/shop/goods/all',
        'desc'   => '获取商品列表',
        'method' => 'GET',
        'return' => '商品信息',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'cate_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品分类ID',
            ],
            [
                'field'   => 'order',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '排序字段',
            ],
            [
                'field'   => 'dir',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '排序方向',
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
                'desc'    => '分页',
            ],
        ],
    ],

    'ShopGoodsThumb' => [
        'url'    => '/api/shop/goods/thumb',
        'desc'   => '获取一个商品的相册',
        'method' => 'GET',
        'return' => '相册列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商品ID',
            ],
        ],
    ],

    'ShopInfoDelPhoto' => [
        'url'    => '/api/shop/info/del-photo',
        'desc'   => '删除一个照片',
        'method' => 'POST',
        'return' => 'success = 1',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'res_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '类别[shop|goods]',
            ],
            [
                'field'   => 'res_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标ID',
            ],
            [
                'field'   => 'photo_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '图片id',
            ],
        ],
    ],

    'ShopInfoCoverPhoto' => [
        'url'    => '/api/shop/info/cover-photo',
        'desc'   => '指定一张照片为封面',
        'method' => 'POST',
        'return' => 'success = 1',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'res_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '类别[shop|goods]',
            ],
            [
                'field'   => 'res_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标ID',
            ],
            [
                'field'   => 'photo_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '图片id',
            ],
        ],
    ],
    
    'OrderInfoAll' => [
        'url'    => '/api/order/info/all',
        'desc'   => '获取订单列表',
        'method' => 'GET',
        'return' => '返回订单详情列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'pro_status',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单状态',
            ],
            [
                'field'   => 'cusotmer_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '客户ID',
            ],
            [
                'field' =>'is_cod',          
                'default' => '0',
                'type'    => 'text',
                'desc'=>'是否货到付款',
            ],
            [
                'field' =>'create_at_start',  
                'default' => '0',
                'type'    => 'text',
                'desc' => '下单开始时间'
            ],
            [

                'field' => 'create_at_end',
                'default' => '0',
                'type'    => 'text',
                'desc' => '下结束时间'
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '一页数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '当前页数',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'OrderInfoChangeStatus' => [
        'url'    => '/api/order/info/change-status',
        'desc'   => '修改订单状态',
        'method' => 'POST',
        'return' => '返回订单详情',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单ID',
            ],
            [
                'field'   => 'pro_status',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '订单状态',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'OrderInfoDetail' => [
        'url'    => '/api/order/info/detail',
        'desc'   => '获取订单详情',
        'method' => 'GET',
        'return' => '返回订单详情',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'order_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '商户ID',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    'CommentEntryAdd' => [
        'url'    => '/api/comment/entry/add',
        'desc'   => '添加一条评论, 商户版一般为店主回复客户的评论 res_name = comment',
        'method' => 'POST',
        'return' => '评论条目自身',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'res_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标类型',
            ],
            [
                'field'   => 'res_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '店铺名字',
            ],
            [
                'field'   => 'content',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '评论内容',
            ],
        ],
    ],

    'CommentEntryAmount' => [
        'url'    => '/api/comment/entry/amount',
        'desc'   => '获取一种类型的评论',
        'method' => 'GET',
        'return' => '评论条目自身',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'res_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标类型',
            ],
            [
                'field'   => 'res_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标ID',
            ],
        ],
    ],
//-----------------------------------------------------------------------------
    'CommentEntryAll' => [
        'url'    => '/api/comment/entry/all',
        'desc'   => '获取一个目标的评论',
        'method' => 'get',
        'return' => '评论列表',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token'
            ],
            [
                'field'   => 'res_name',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标类型[订单:order, 回复: comment]'
            ],
            [
                'field'   => 'res_id',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '目标ID[订单ID, 评论本身的ID]',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '获取数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '获取页数',
            ],
        ],
    ],

//-----------------------------------------------------------------------------

    'ShopInfoScore' => 
    [
        'url'    => '/api/shop/info/score',
        'desc'   => '获取自己店铺的最新的平均分',
        'method' => 'GET',
        'return' => '平均分',
        'over'   => 1,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
        ],
    ],
//-----------------------------------------------------------------------------
    
    'StaOrder' => 
    [
        'url'    => '/api/sta/order',
        'desc'   => '订单统计页面汇总信息',
        'method' => 'GET',
        'return' => '数据组合',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
        ],
    ],

    'StaOrderTrend' => 
    [
        'url'    => '/api/sta/order/trend',
        'desc'   => '获取每订单趋势汇总',
        'method' => 'GET',
        'return' => '数据组合',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'type_sta',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '统计类型 week|month|quarter|year',
            ],
        ],
    ],

//-----------------------------------------------------------------------------
    
    'StaOrderGoods' => 
    [
        'url'    => '/api/sta/order/goods',
        'desc'   => '商品排行',
        'method' => 'GET',
        'return' => '数据组合',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'type_sta',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '统计类型 week|month|quarter|year',
            ],
        ],
    ],

    'StaOrderEveryDay' => 
    [
        'url'    => '/api/sta/order/every-day',
        'desc'   => '每日汇总',
        'method' => 'GET',
        'return' => '数据组合',
        'over'   => 0,
        'params' => [
            [
                'field'   => 'token',
                'default' => '0',
                'type'    => 'text',
                'desc'    => 'token',
            ],
            [
                'field'   => 'amount',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '获取数量',
            ],
            [
                'field'   => 'page',
                'default' => '0',
                'type'    => 'text',
                'desc'    => '获取页数',
            ],
        ],
    ],
];
