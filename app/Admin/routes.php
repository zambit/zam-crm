<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
	return AdminSection::view($content, 'Dashboard');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Define your information here.';
	return AdminSection::view($content, 'Information');
}]);

Route::get('investors', ['as' => 'admin.investors', function () {
    $content = 'Define your information here.';
    return AdminSection::view($content, 'Investors');
}]);