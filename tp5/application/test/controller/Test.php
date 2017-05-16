<?php
/* 
* @Author: yangjie-jerry
* @Date:   2017-05-10 17:41:46
* @Last Modified by:   yangjie-jerry
* @Last Modified time: 2017-05-11 16:24:58
*/

namespace app\Test\controller;

use \think\View;
/**
* 
*/
class Test
{
    
    public function __construct()
    {
        # code...
    }

    public function test()
    {
        // 不带任何参数 自动定位当前操作的模板文件
        $tranData = $this->groupTranData();
        //echo $tranData;exit;
        $view = new View();
        $view->name = 'jerry';
        return $view->fetch();
    }

    //组合trandata
    public function groupTranData()
    {
        $data = array(
            'interfaceName' => 'ICBC_PERBANK_B2C',
            'interfaceVersion' => '1.0.0.11',
            'orderDate' => date('YmdHis',time()),
            'orderid' => '',
            'amount' => '',
            'installmentTimes' => '1',
            //商户账号
            'merAcct' => '',
            'goodsName' => '',
            'goodsNum' => '',
            'verifyJoinFlag' => '1',
            'curType' => '001',
            //商户代码
            'merID' => '',
            'creditType' => '2',
            'notifyType' => 'HS',
            'resultType' => '0',
            'goodsAddress' => '',
            //商户返回url
            'merURL' => '',
            );

        //组合工行固定的xml格式
       $dataXml = 
       '<?xml version="1.0" encoding="GBK" standalone="no"?>
        <B2CReq>
        <interfaceName>'.$data["interfaceName"].'</interfaceName>
        <interfaceVersion>'.$data['interfaceVersion'].'</interfaceVersion>
        <orderInfo>
            <orderDate>'.$data['orderDate'].'</orderDate>
            <curType>'.$data['curType'].'</curType>
            <merID>'.$data['merID'].'</merID>
            <subOrderInfoList>
            <subOrderInfo>
                <orderid>'.$data['orderid'].'</orderid>
                <amount>'.$data['amount'].'</amount>
                <installmentTimes>'.$data['installmentTimes'].'</installmentTimes>
                <merAcct>'.$data['merAcct'].'</merAcct>
                <goodsID></goodsID>
                <goodsName></goodsName>
                <goodsNum></goodsNum>
                <carriageAmt></carriageAmt>
            </subOrderInfo>
            </subOrderInfoList>
        </orderInfo>
        <custom>
            <verifyJoinFlag>'.$data['verifyJoinFlag'].'</verifyJoinFlag>
            <Language></Language>
        </custom>
        <message>
            <creditType>'.$data['creditType'].'</creditType>
            <notifyType>'.$data['notifyType'].'</notifyType>
            <resultType>'.$data['resultType'].'</resultType>
            <merReference></merReference>
            <merCustomIp></merCustomIp>
            <goodsType></goodsType>
            <merCustomID></merCustomID>
            <merCustomPhone></merCustomPhone>
            <goodsAddress>'.$data['goodsAddress'].'</goodsAddress>
            <merOrderRemark></merOrderRemark>
            <merHint></merHint>
            <remark1></remark1>
            <remark2></remark2>
            <merURL>'.$data['merURL'].'</merURL>
            <merVAR></merVAR>
        </message>
        <extend>
        <e_isMerFlag></e_isMerFlag>
        <e_Name></e_Name>
        <e_TelNum></e_TelNum>
        <e_CredType></e_CredType>
        <e_CredNum></e_CredNum>
        <e_CardNo></e_CardNo>
        <orderFlag_ztb></orderFlag_ztb>
        </extend>
        </B2CReq>';

        $dataXmlBase64 = base64_encode($dataXml);

        return $dataXmlBase64;

    }


}

?>
