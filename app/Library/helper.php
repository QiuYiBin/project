<?php


	//发送短信校验码
	function sendsphone($p){
		//初始化必填
		//填写在开发者控制台首页上的Account Sid
		$options['accountsid']='b323cfa07e48079263d5d3a742bfea4e';
		//填写在开发者控制台首页上的Auth Token
		$options['token']='12a34f4d6f70a7c27c2e5f4841559efb';
		//初始化 $options必填
		$ucpass = new Ucpaas($options);
		$appid = "46e72b4dd061401a94d687d28083a74b"; //应用的ID，可在开发者控制台内的短信产品下查看
		$templateid = "399756"; //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模
		// 板ID
		$param = rand(1,10000); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则
		// 留空
		setcookie('fcode',$param,time()+60);
		$mobile = $p;
		$uid = "";
		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条
		// 发送。分割后的多条短信将按照具体占用条数计费。
		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
	}

	
	function curlGet($url,$method,$post_data=0){
		//初始化curl
		$ch=curl_init();
		//设置传输选项
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		if($method=='post'){
		// CURLOPT_POST 模拟post请求
		curl_setopt($ch,CURLOPT_POST,1);
		//传递参数 CURLOPT_POSTFIELDS
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		}elseif($method=="get"){
		// CURLOPT_HEADER 在请求头部添加信息
		curl_setopt($ch,CURLOPT_HEADER,0);
		} 
		//执行curl
		$res=curl_exec($ch);
		//关闭curl
		curl_close($ch);
		return $res;
		
	}

	function pay($out_trade_no,$subject,$total_fee)
	{
		/* *
		 * 功能：即时到账交易接口接入页
		 * 版本：3.4
		 * 修改日期：2016-03*08
		 * 说明：
		 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
		 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

		 *************************注意*****************
		 
		 *如果您在接口集成过程中遇到问题，可以按照下面的途径来解决
		 *1、开发文档中心（https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.KvddfJ&treeId=62&articleId=103740&docType=1）
		 *2、商户帮助中心（https://cshall.alipay.com/enterprise/help_detail.htm?help_id=473888）
		 *3、支持中心（https://support.open.alipay.com/alipay/support/index.htm）

		 *如果想使用扩展功能,请按文档要求,自行添加到parameter数组即可。
		 **********************************************
		 */

		require_once("alipay.config.php");
		require_once("lib/alipay_submit.class.php");

		/**************************请求参数**************************/
		        //商户订单号，商户网站订单系统中唯一订单号，必填
		        $out_trade_no = $out_trade_no;

		        //订单名称，必填
		        $subject = $subject;

		        //付款金额，必填
		        $total_fee = $total_fee;

		        //商品描述，可空
		        $body = '手机';





		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service"       => $alipay_config['service'],
				"partner"       => $alipay_config['partner'],
				"seller_id"  => $alipay_config['seller_id'],
				"payment_type"	=> $alipay_config['payment_type'],
				"notify_url"	=> $alipay_config['notify_url'],
				"return_url"	=> $alipay_config['return_url'],
				
				"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
				"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
				//其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
		        //如"参数名"=>"参数值"
				
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;

	}
 ?>
