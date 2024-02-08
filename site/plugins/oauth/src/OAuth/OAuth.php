<?php

namespace Kirby\OAuth;

use Kirby\Cms\App;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Http\Response;
use Kirby\Session\Session;
use League\OAuth2\Client\Provider\LinkedIn;
use League\OAuth2\Client\Provider\Github;
use Wohali\OAuth2\Client\Provider\Discord;

class OAuth
{
	public App $kirby;
	public string|null $provider;
	public Session $session;
	public string|null $token;
	public array|null $user;

	/**
	 * Creates a new Oauth instance
	 */
	public function __construct()
	{
		$this->kirby    = App::instance();
		$this->session  = $this->kirby->session();
		$this->provider = $this->session->get('oauth.provider');
		$this->token    = $this->session->get('oauth.token');
		$this->user     = $this->session->get('oauth.user');
	}

	/**
	 * Checks if the user is logged in
	 */
	public function isLoggedIn(): bool
	{
		return $this->user !== null && $this->token !== null;
	}

	/**
	 * Runs the Oauth flow for the given provider
	 */
	public function login(
		string $provider,
		string $clientId,
		string $clientSecret,
		string $redirectUri
	): array {
		$providers = [
			'discord'  => Discord::class,
			'github'   => Github::class,
		];

		if (array_key_exists($provider, $providers) === false) {
			throw new InvalidArgumentException('Invalid OAuth provider');
		}

		$class  = $providers[$provider];
		$client = new $class([
			'clientId'          => $clientId,
			'clientSecret'      => $clientSecret,
			'redirectUri'       => $redirectUri,
		]);

		$code  = $this->kirby->request()->get('code');
		$state = $this->kirby->request()->get('state');

		// If we don't have an authorization code then get one
		if (empty($code)) {
			$authUrl = $client->getAuthorizationUrl();
			$this->session->set('oauth.state', $client->getState());

			die(Response::redirect($authUrl));
		}

		// Check given state against previously stored one to mitigate CSRF attack
		if (empty($state) || $state !== $this->session->get('oauth.state')) {
			$this->session->remove('oauth.state');
			throw new InvalidArgumentException('Invalid state');
		}

		// the state is no longer needed
		$this->session->remove('oauth.state');

		// Try to get an access token (using the authorization code grant)
		$token = $client->getAccessToken('authorization_code', [
			'code' => $code
		]);

		// We got an access token, let's now get the user's details
		$user = $client->getResourceOwner($token);

		$this->provider = $provider;
		$this->token    = $token->getToken();
		$this->user     = $user->toArray();

		$this->session->set('oauth.provider', $this->provider);
		$this->session->set('oauth.token', $this->token);
		$this->session->set('oauth.user', $this->user);

		return [
			'provider' => $this->provider,
			'token'    => $this->token,
			'user'     => $this->user,
		];
	}

	/**
	 * Removes the token and user
	 * from the session
	 */
	public function logout(): bool
	{
		$this->provider = null;
		$this->token    = null;
		$this->user     = null;

		$this->session->remove('oauth.provider');
		$this->session->remove('oauth.token');
		$this->session->remove('oauth.user');

		return true;
	}

	/**
	 * Returns the last used provider
	 */
	public function provider(): string|null
	{
		return $this->provider;
	}

	/**
	 * Returns the access token if
	 * the authentication worked
	 */
	public function token(): string|null
	{
		return $this->token;
	}

	/**
	 * Returns an array with user information
	 * if the authentication worked
	 */
	public function user(): array|null
	{
		return $this->user;
	}
}
