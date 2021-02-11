(function(){
	
	var BDTASK = {
		baseUrl: function(){
			return '<?php echo base_url(); ?>';
		},
		siteUrl: function(){
			return '<?php echo site_url(); ?>';
		},
		getBaseAction: function(action){
			return '<?php echo base_url(); ?>' + action;
		},
		getSiteAction: function(action){
			return '<?php echo site_url(); ?>' + action;
		},
		language: function(){
			return '<?php echo $settings->language; ?>';
		},
		market_details: function(){
			return '<?php echo json_encode($market_details); ?>';
		},
		buyfees: function(){
			return '<?php if(!empty($fee_to->fees)){ echo $fee_to->fees; } else { echo '0';} ?>';
		},
		sellfees: function(){
			return '<?php if(!empty($fee_from->fees)){ echo $fee_from->fees; } else { echo '0';} ?>';
		},
		coin_stream: function(){
			return '<?php if(!empty($coin_stream)) echo $coin_stream ?>';
		},
		csrf_hash: function(){
			return '<?php if(!empty($get_csrf_hash)) echo $get_csrf_hash ?>';
		},
		csrf_token: function(){
			return '<?php if(!empty($csrf_token)) echo $csrf_token ?>';
		},
		gateway: function(){
			return '<?php if(!empty($gateway)) echo json_encode($gateway)?>';
		},
		gateway_bank: function(){
			return '<?php if(!empty($gateway_bank)) echo $gateway_bank ?>';
		},
		phrase: function(){
			return '<?php if(!empty($language)) echo $language ?>';
		},
		theme: function(){
			return '<?php if(!empty($theme)) echo $theme; ?>';
		},
		crypto_api: function(){
			return '<?php if(!empty($crypto_key)) echo $crypto_key; ?>';
		}
	};
	window.BDTASK = BDTASK;
}());