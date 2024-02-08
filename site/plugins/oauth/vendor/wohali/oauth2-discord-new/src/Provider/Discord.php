<?php
/**
 * This file is part of the wohali/oauth2-discord-new library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Joan Touzet <code@atypical.net>
 * @license http://opensource.org/licenses/MIT MIT
 * @link https://packagist.org/packages/wohali/oauth2-discord-new Packagist
 * @link https://github.com/wohali/oauth2-discord-new GitHub
 */

namespace Wohali\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use Wohali\OAuth2\Client\Provider\Exception\DiscordIdentityProviderException;

class Discord extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * Default host
     *
     * @var string
     */
    public $host = 'https://discord.com';

    /**
     * API domain
     *
     * @var string
     */
    public $apiDomain = 'https://discord.com/api/v9';

    /**
     * Get authorization URL to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return $this->host.'/oauth2/authorize';
    }

    /**
     * Get access token URL to retrieve token
     *
     * @param  array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->apiDomain.'/oauth2/token';
    }

    /**
     * Get provider URL to retrieve user details
     *
     * @param  AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->apiDomain.'/users/@me';
    }

    /**
     * Returns the string that should be used to separate scopes when building
     * the URL for requesting an access token.
     *
     * Discord's scope separator is space (%20)
     *
     * @return string Scope separator
     */
    protected function getScopeSeparator()
    {
        return ' ';
    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [
            'identify',
            'email',
            'connections',
            'guilds',
            'guilds.join'
        ];
    }

    /**
     * Check a provider response for errors.
     *
     * @param  ResponseInterface $response
     * @param  array $data Parsed response data
     * @return void
     *
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw DiscordIdentityProviderException::clientException($response, $data);
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param  array $response
     * @param  AccessToken $token
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new DiscordResourceOwner($response);
    }
}
