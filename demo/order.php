<?php
require_once __DIR__ . '/../autoload.php';
use Qdysup\Client;

$qdy=new Client('L23442545347','MTIzNDU2');
$qdy->app_url="https://sup.dev.tuoyukj.com/";
$param =[
    'address'=>[
        'consignee' => '小胜',
        'phone' => '13000000000',
        'province' => '北京市',
        'city' => '北京市',
        'area' => '丰台区',
        'street' => '卢沟桥街道',
        'description' => '和谐银座商场',
    ],

    'spu' => [
        [
            'sku'=>5542227,
            'number'=>1,
        ],
    ],
];
$ret=$qdy->apiSend('v1/order/commit_order',$param);
var_dump($ret);
$ret=$qdy->apiSend("v1/goods/get-bulk-goods-detail",$param);
var_dump($ret);