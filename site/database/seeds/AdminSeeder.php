<?php

use Ykings\User;

class AdminSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
		DB::table('groups')->truncate();
		DB::table('users_groups')->truncate();

		Sentinel::registerAndActivate(array(
			'email'       => 'admin@admin.com',
			'password'    => "admin123",
			'first_name'  => 'John',
			'last_name'   => 'Doe',
			'activated'   => 1,
		));

//		Sentry::getGroupProvider()->create(array(
//			'name'        => 'Admin',
//			'permissions' => array('admin' => 1),
//		));
//
//		Sentry::getGroupProvider()->create(array(
//			'name'        => 'User',
//			'permissions' => array('admin' => 0),
//		));

		// Assign user permissions
//		$adminUser  = Sentry::getUserProvider()->findByLogin('admin@admin.com');
//		$adminGroup = Sentry::getGroupProvider()->findByName('Admin');
//		$adminUser->addGroup($adminGroup);
	}

}