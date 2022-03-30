<?php namespace Octobro\Location;

use Backend;
use System\Classes\PluginBase;

/**
 * Location Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Location',
            'description' => 'No description provided yet...',
            'author'      => 'Octobro',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Octobro\Location\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'octobro.location.some_permission' => [
                'tab' => 'Location',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'location' => [
                'label'       => 'Location',
                'url'         => Backend::url('octobro/location/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['octobro.location.*'],
                'order'       => 500,
            ],
        ];
    }

    /**
     * Registers back-end settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'subdistricts' => [
                'label'       => 'Subdistricts',
                'description' => 'Manage subdistricts',
                'category'    => 'rainlab.location::lang.plugin.name',
                'url'         => Backend::url('octobro/location/subdistricts'),
                'icon'        => 'icon-map-marker',
                'permissions' => ['rainlab.location.access_settings'],
                'order'       => 500,
                'keywords'    => 'subdistricts',
            ],
            'districts' => [
                'label'       => 'Districts',
                'description' => 'Manage districts',
                'category'    => 'rainlab.location::lang.plugin.name',
                'url'         => Backend::url('octobro/location/districts'),
                'icon'        => 'icon-map-marker',
                'permissions' => ['rainlab.location.access_settings'],
                'order'       => 500,
                'keywords'    => 'districts',
            ]
        ];
    }
}
