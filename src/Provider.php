<?php
namespace venveo\oauthinfusionsoft;

use League\OAuth2\Client\Provider\AbstractProvider;
use venveo\oauthclient\base\Provider as BaseProvider;
use AdEspresso\OAuth2\Client\Provider\Infusionsoft as InfusionsoftProvider;
/**
 * @package venveo\oauthinfusionsoft
 */
class Provider extends BaseProvider
{
    public static function displayName(): string
    {

        return 'Infusionsoft';
    }

    public function getConfiguredProvider(): InfusionsoftProvider
    {
        if ($this->configuredProvider instanceof AbstractProvider) {
            return $this->configuredProvider;
        }

        $this->configuredProvider = new InfusionsoftProvider([
            'clientId' => $this->getApp()->getClientId(),
            'clientSecret' => $this->getApp()->getClientSecret(),
            'redirectUri' => $this->getApp()->getRedirectUrl(),
            'accessType' => 'offline',
        ]);
        return $this->configuredProvider;
    }

    /**
     * @param array $options
     * @return String
     */
    public function getAuthorizeURL($options = []): String {
        return $this->getConfiguredProvider()->getAuthorizationUrl(
            array_merge([
                'scope' => $this->getApp()->getScopes(),
                'approval_prompt' => 'force'
            ],
                $options)
        );
    }
}
