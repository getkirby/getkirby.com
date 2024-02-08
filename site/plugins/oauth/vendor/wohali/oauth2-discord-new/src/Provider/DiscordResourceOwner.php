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

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class DiscordResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param  array $response
     * @return void
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource owner ID
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getValueByKey($this->response, 'id');
    }

    /**
     * Get resource owner username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->getValueByKey($this->response, 'username');
    }

    /**
     * Get resource owner discriminator
     *
     * @return string|null
     */
    public function getDiscriminator()
    {
        return $this->getValueByKey($this->response, 'discriminator');
    }

    /**
     * Get resource owner avatar hash
     *
     * @return string|null
     */
    public function getAvatarHash()
    {
        return $this->getValueByKey($this->response, 'avatar');
    }

    /**
     * Get resource owner verified flag
     *
     * @return bool
     */
    public function getVerified()
    {
        return $this->getValueByKey($this->response, 'verified', false);
    }

    /**
     * Get resource owner email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getValueByKey($this->response, 'email');
    }

    /**
     * Returns the raw resource owner response.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
