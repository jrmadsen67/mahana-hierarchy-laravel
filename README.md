###Mahana Hierarchy Laravel###

Laravel package version of the Mahana Hierarchy module found here: https://github.com/jrmadsen67/mahana-hierarchy

A complete description of the functionality is located here: http://www.codebyjeff.com/blog/2012/10/nested-data-with-mahana-hierarchy-library

###Installation###

Available (recommended) via composer:

	"require": {
		 "jrmadsen67/mahana-hierarchy-laravel": "dev-master"
	}

In you Laravel app.php file add this to providers:

	'Jrmadsen67\MahanaHierarchyLaravel\MahanaHierarchyLaravelServiceProvider'

and this to your facades (optional):

	 'MahanaHierarchy' 	  => 'Jrmadsen67\MahanaHierarchyLaravel\Facades\HierarchyFacade'

then run the migration:

	php artisan migrate --package="jrmadsen67/mahana-hierarchy-laravel"

You may run these line to check that the installation is correct:

	$data = ['name' => 'A parent', 'parent_id' => 0 ];
    $insert = MahanaHierarchy::insert($data);
    $row = MahanaHierarchy::get($insert->id);


A data seeder for experimenting and testing is coming soon.

###Configuration###

Table name and fields are completely configurable to your needs. Simply publish the package with the following:

	php artisan config:publish jrmadsen67/mahana-hierarchy-laravel

IMPORTANT! If you wish to use the included migration, run the publish config line BEFORE the migration and your new table 
name and fields will be used.
 
###Differences in this release###

Aside from being a Laravel package, I have not yet fully set up the configuration to allow multiple instances and to easily change all the tabel and field names. This is coming very shortly (the main library is already set up this way, but supporting classes are not).

###Testing###

This is fully tested, but proper Unit Testing is not yet included until done a little more...er, "properly".

