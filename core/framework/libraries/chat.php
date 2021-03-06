<?php
/**
 * chat
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InShopNC') or exit('Access Invalid!');

class Chat {
	public static function getChatHtml($layout){
		$web_html = '';
		if ($layout != 'layout/msg_layout.php'){
			$config_file = BASE_ROOT_PATH.DS.'chat'.DS.'config'.DS."config.ini.php";
			require_once $config_file;
			$avatar = getMemberAvatar($_SESSION['avatar']);
			$nchash = getNchash();
			$formhash = Security::getTokenValue();
			$css_url = CHAT_TEMPLATES_URL;
			$app_url = APP_SITE_URL;
			$chat_url = CHAT_SITE_URL;
			$node_url = NODE_SITE_URL;
			$shop_url = MAIN_SITE_URL;
			
			$web_html = <<<EOT
					<link href="{$css_url}/css/chat.css" rel="stylesheet" type="text/css">
					<link href="{$css_url}/css/home_login.css" rel="stylesheet" type="text/css">
					<div style="clear: both;"></div>
					<div id="web_chat_dialog" style="display: none;float:right;">
					</div>
					<a id="chat_login" href="javascript:void(0)" style="display: none;"></a> 
					<script type="text/javascript">
					var APP_SITE_URL = '{$app_url}';
					var CHAT_SITE_URL = '{$chat_url}';
					var MAIN_SITE_URL = '{$shop_url}';
					var connect_url = "{$node_url}";
					
					var layout = "{$layout}";
					var act_op = "{$_GET['act']}_{$_GET['op']}";
					var user = {};
					
					user['u_id'] = "{$_SESSION['member_id']}";
					user['u_name'] = "{$_SESSION['member_name']}";
					user['s_id'] = "{$_SESSION['store_id']}";
					user['s_name'] = "{$_SESSION['store_name']}";
					user['avatar'] = "{$avatar}";
					
					$("#chat_login").nc_login({
					  action:'/index.php?act=login',
					  nchash:'{$nchash}',
					  formhash:'{$formhash}'
					});
					</script>
EOT;
			if (defined('APP_ID') && APP_ID != 'shop'){
				$web_html .= '<script type="text/javascript" src="'.RESOURCE_SITE_URL.'/js/perfect-scrollbar.min.js"></script>';
				$web_html .= '<script type="text/javascript" src="'.RESOURCE_SITE_URL.'/js/jquery.mousewheel.js"></script>';
			}
			$web_html .= '<script type="text/javascript" src="'.RESOURCE_SITE_URL.'/js/jquery.charCount.js" charset="utf-8"></script>';
			$web_html .= '<script type="text/javascript" src="'.RESOURCE_SITE_URL.'/js/jquery.smilies.js" charset="utf-8"></script>';
			$web_html .= '<script type="text/javascript" src="'.CHAT_RESOURCE_URL.'/js/user.js" charset="utf-8"></script>';
			
		}
		return $web_html;
	}
}
?>