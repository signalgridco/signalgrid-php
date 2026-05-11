# Signalgrid PHP Client
[![Latest Version on Packagist](https://img.shields.io/packagist/v/signalgridco/signalgrid-php)](https://packagist.org/packages/signalgridco/signalgrid-php)

Official PHP client for the Signalgrid push-notification API.

## Installation

```bash
composer require signalgridco/signalgrid-php
```
## Example
```php
require __DIR__ . '/vendor/autoload.php';

use Signalgrid\Client;
use Signalgrid\Exception;

try {
    $client = new Client('YOUR_CLIENT_KEY');

    $response = $client->send([
        'channel'  => 'CHANNEL_TOKEN',
        'type'     => 'info',
        'title'    => 'Hello from PHP',
        'body'     => 'This notification was sent using the Signalgrid PHP client.',
        'critical' => false
    ]);

    print_r($response);

} catch (Exception $e) {
    echo $e->getMessage();
}
```
## Response
```
Array
(
    [ruuid] => 356b625e6ae18f8f2c5381633bc90028acbb119c
    [text] => OK
    [code] => 200
    [node] => dp02
    [time] => 360ms
)
```
