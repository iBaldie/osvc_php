<?php

namespace OSvCPHP;

use OSvCPHP;

class Config
{
	public $no_ssl_verify,$suppress_rules,$login,$base_url;

	private function hidden_credentials($credential_string)
	{
		return base64_encode($credential_string);
	}

	private function client_url($config_hash)
	{
		$base_url = "https://" . $config_hash['interface'] . ".";

		if(isset($config_hash['demo_site']) && $config_hash['demo_site'] === true){
			$base_url .= "rightnowdemo.com/services/rest/connect/";
		}else{
			$base_url .= "custhelp.com/services/rest/connect/";
		}

		if(isset($config_hash['version'])){
			$base_url .= $config_hash['version'];
		}else{
			$base_url .= "v1.3";
		}

		return $base_url . "/";
	}

	public function __construct($config_hash)
	{
		$this->login = self::hidden_credentials($config_hash['username'] .":". $config_hash['password'] );
		$this->no_ssl_verify = isset($config_hash['no_ssl_verify']) ? $config_hash['no_ssl_verify'] : false;
		$this->suppress_rules = isset($config_hash['suppress_rules']) ? $config_hash['suppress_rules'] : false;
		$this->base_url = self::client_url($config_hash);
	}
}