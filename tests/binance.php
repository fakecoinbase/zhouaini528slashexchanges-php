<?php

/**
 * @author lin <465382251@qq.com>
 * 
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/binance-php.git
 * */

use Lin\Exchange\Exchanges;

require __DIR__ .'../../vendor/autoload.php';

include 'key_secret.php';
$key=$keysecret['binance']['key'];
$secret=$keysecret['binance']['secret'];

$exchanges=new Exchanges('binance',$key,$secret);

$action=intval($_GET['action'] ?? 0);//http pattern
if(empty($action)) $action=intval($argv[1]);//cli pattern

switch ($action){
    //******************************Spot
    //***********Spot Market
    case 100:{
        $result=$exchanges->trader()->buy([
            '_symbol'=>'BTCUSDT',
            '_number'=>'0.01',
        ]);
        break;
    }
    case 101:{
        //The original parameters
        $result=$exchanges->trader()->buy([
            'symbol'=>'BTCUSDT',
            'type'=>'MARKET',
            'quantity'=>'0.01',
        ]);
        break;
    }
    
    case 102:{
        $result=$exchanges->trader()->sell([
            '_symbol'=>'BTCUSDT',
            '_number'=>'0.01',
        ]);
        break;
    }
    case 103:{
        //The original parameters
        $result=$exchanges->trader()->sell([
            'symbol'=>'BTCUSDT',
            'type'=>'MARKET',
            'quantity'=>'0.01',
        ]);
        break;
    }
    
    //***********Spot Limit
    case 150:{
        $result=$exchanges->trader()->buy([
            '_symbol'=>'BTCUSDT',
            '_number'=>'0.01',
            '_price'=>'2000',
        ]); 
        break;
    }
    case 151:{
        //The original parameters
        $_client_id=md5(rand(1,999999999));//custom ID
        $result=$exchanges->trader()->buy([
            'newClientOrderId'=>$_client_id,
            'symbol'=>'BTCUSDT',
            'type'=>'LIMIT',
            'quantity'=>'0.01',
            'price'=>'2000',
            'timeInForce'=>'GTC',
        ]);
        break;
    }
    
    case 152:{
        $result=$exchanges->trader()->sell([
            '_symbol'=>'BTCUSDT',
            '_number'=>'0.01',
            '_price'=>'9000',
        ]);
        break;
    }
    case 153:{
        //The original parameters
        $_client_id=md5(rand(1,999999999));//custom ID
        $result=$exchanges->trader()->sell([
            'newClientOrderId'=>$_client_id,
            'symbol'=>'BTCUSDT',
            'type'=>'LIMIT',
            'quantity'=>'0.01',
            'price'=>'9000',
            'timeInForce'=>'GTC',
        ]);
        break;
    }
    
    case 300:{
        $result=$exchanges->trader()->show([
            '_symbol'=>'BTCUSDT',
            '_order_id'=>'324314658',
        ]);
        break;
    }
    case 301:{
        $result=$exchanges->trader()->show([
            'symbol'=>'BTCUSDT',
            'orderId'=>'324317395',
            //'origClientOrderId'=>'',
        ]);
        break;
    }
    
    case 302:{
        $result=$exchanges->trader()->cancel([
            '_symbol'=>'BTCUSDT',
            '_order_id'=>'324314658',
        ]);
        break;
    }
    case 303:{
        $result=$exchanges->trader()->cancel([
            'symbol'=>'BTCUSDT',
            'orderId'=>'324317395',
            //'origClientOrderId'=>'',
        ]);
        break;
    }
    
    
    //******************************Complete spot flow
    case 400:{
        $result=$exchanges->trader()->buy([
            '_symbol'=>'BTCUSDT',
            '_number'=>'0.01',
            '_price'=>'2000',
        ]);
        print_r($result);
        
        $result=$exchanges->trader()->cancel([
            '_symbol'=>'BTCUSDT',
            '_order_id'=>$result['orderId'],
        ]);
        
        break;
    }
    
    //******************************Complete future flow
    case 450:{
        
        
        break;
    }
    
    case 0:{
        break;
    }
    
    default:{
        echo 'nothing';
        exit;
    }
}
print_r($result);