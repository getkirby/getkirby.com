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

namespace Wohali\OAuth2\Client\Provider\Exception;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Psr\Http\Message\ResponseInterface;

class DiscordIdentityProviderException extends IdentityProviderException
{
    /**
     * Creates client exception from response
     *
     * @param  ResponseInterface $response
     * @param  array $data Parsed response data
     * @return IdentityProviderException
     */
    public static function clientException(ResponseInterface $response, $data)
    {
        return static::fromResponse(
            $response,
            $data['message'] ?? json_encode($data)
        );
    }

    /**
     * Creates identity exception from response
     *
     * @param  ResponseInterface $response
     * @param  string $message
     * @return IdentityProviderException
     */
    protected static function fromResponse(ResponseInterface $response, $message = null)
    {
        return new static($message, $response->getStatusCode(), (string) $response->getBody());
    }
}
