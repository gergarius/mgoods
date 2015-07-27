<?php
function sho($v) {
	echo '<pre>';
	print_r($v);
	echo '</pre>';
}

function shodie($v) {
	sho($v);
	die();
}

return [
	'adminEmail'        => 'admin@example.com',
	'supportEmail'      => 'info@example.com',
	'DataDomain'        => [
		'ru' => 'dev.goods.marketgid.com',
	],
	'CatalogDataDomain' => 'dev.goods.marketgid.com',
	'defaultLang'       => 'ru',
	'defaultCurrency'   => 'USD',
	'user.passwordResetTokenExpire' => 3600,
];
