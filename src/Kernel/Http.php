<?php

namespace Onekb\Gdrcu\Kernel;

use Onekb\Gdrcu\Contracts\HttpInterface;
use Onekb\Gdrcu\Kernel\Response;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Onekb\Gdrcu\Exceptions\InvalidConfigException;
use Psr\Http\Message\ResponseInterface;

class Http implements HttpInterface
{
    /**
     * @var \Onekb\Gdrcu\Kernel\ServiceContainer
     */
    protected $app;

    protected $host = "";

    protected ClientInterface $client;

    public function __construct($app)
    {
        $this->app = $app;

        $this->host = $this->app->config->get('host');

        $this->client = $this->getClient();
    }

    protected function getClient(): ClientInterface
    {
        $config = [
            'base_uri' => $this->host
        ];
        return new Client($config);
    }

    public function get(string $path)
    {
        return $this->client->request('GET', $path);
    }

    public function post(string $path, array $data)
    {
        $options = [
            'json' => $data
        ];
        // return $this->client->request('POST', $path, $options);
        return $this->request($path, 'post', $options);
    }

    public function put(string $path, array $data)
    {
        $options = [
            'json' => $data
        ];
        return $this->client->request('PUT', $path, $options);
    }

    public function delete(string $path, array $data = [])
    {
        $options = [
            'json' => $data
        ];
        return $this->client->request('GET', $path, $options);
    }

    protected function request(string $path, $method = 'post', array $options = [])
    {
        $tranCode = $options['json']['service']['head']['tranCode'];

        $body = $options['json']['service']['body'];

        $sign = $this->app->sign->encode($tranCode, $body);

        $options['json']['service']['head']['signature'] = $sign;

        $response = $this->client->request($method, $path, $options);

        return $this->castResponseToType($response, $this->app->config->get('response_type', 'raw'));
    }

    protected function castResponseToType(ResponseInterface $response, $type = null)
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        switch ($type ?? 'array') {
            case 'collection':
                return $response->toCollection();
            case 'array':
                return $response->toArray();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, Arrayable::class)) {
                    throw new InvalidConfigException(sprintf('Config key "response_type" classname must be an instanceof %s', Arrayable::class));
                }

                return new $type($response);
        }
    }
}