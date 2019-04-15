<?php
/**
 * OAuth Infusionsoft plugin for Craft CMS 3.x
 *
 * Infusionsoft provider for Venveo OAuth Client
 *
 * @link      https://www.venveo.com
 * @copyright Copyright (c) 2019 Venveo
 */

namespace venveo\oauthinfusionsoft;


use Craft;
use craft\base\Plugin as BasePlugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class OauthInfusionsoft
 *
 * @author    Venveo
 * @package   OauthInfusionsoft
 * @since     1.0.0
 *
 */
class Plugin extends BasePlugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Plugin
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            \venveo\oauthclient\services\Providers::class,
            \venveo\oauthclient\services\Providers::EVENT_REGISTER_PROVIDER_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = Provider::class;
            }
        );
    }

    // Protected Methods
    // =========================================================================

}
