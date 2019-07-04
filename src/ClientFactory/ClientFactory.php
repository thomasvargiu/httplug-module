<?php

declare(strict_types=1);

namespace TMV\HTTPlugModule\ClientFactory;

use Http\Client\HttpClient;

interface ClientFactory
{
    public function createClient(array $config = []): HttpClient;
}
