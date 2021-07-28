<?php

namespace Onekb\Gdrcu\Contracts;

use Psr\Http\Message\ResponseInterface;

interface HttpInterface
{
    public function __construct($app);
    public function get(string $path);
    public function post(string $path, array $data);
    public function put(string $path, array $data);
    public function delete(string $path, array $data = []);
}
