<?php

namespace App\Services;

use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\MqttClient;
use Exception;
use Illuminate\Support\Facades\Log;

class MqttService
{
    private $client = null;
    private $isConnected = false;
    private $host;
    private $port;
    private $clientId;
    private $username;
    private $password;
    private $useTls;

    public function __construct()
    {
        $this->host = env('MQTT_HOST', 'broker.emqx.io');
        $this->port = env('MQTT_PORT', 1883);
        $this->clientId = env('MQTT_CLIENT_ID', 'carwash_admin_' . uniqid());
        $this->username = env('MQTT_USERNAME');
        $this->password = env('MQTT_PASSWORD');
        $this->useTls = env('MQTT_USE_TLS', false);
    }

    private function connect(): bool
    {
        if ($this->isConnected) {
            return true;
        }

        try {
            $this->client = new MqttClient($this->host, $this->port, $this->clientId);

            $connectionSettings = (new ConnectionSettings())
                ->setUsername($this->username)
                ->setPassword($this->password)
                ->setKeepAliveInterval(60);

            if ($this->useTls) {
                $connectionSettings->setUseTls(true);
            }

            $this->client->connect($connectionSettings);
            $this->isConnected = true;

            Log::info('MQTT client connected successfully', [
                'host' => $this->host,
                'port' => $this->port,
                'client_id' => $this->clientId,
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error('Failed to connect to MQTT broker', [
                'error' => $e->getMessage(),
                'host' => $this->host,
                'port' => $this->port,
            ]);
            $this->isConnected = false;
            $this->client = null;
            return false;
        }
    }

    public function publish(string $topic, array $payload, int $qos = 0, bool $retain = false): bool
    {
        if (!$this->connect()) {
            Log::warning('MQTT client not connected, cannot publish message');
            return false;
        }

        try {
            $jsonPayload = json_encode($payload, JSON_UNESCAPED_SLASHES);
            
            $this->client->publish($topic, $jsonPayload, $qos, $retain);
            
            Log::info('MQTT message published successfully', [
                'topic' => $topic,
                'payload' => $payload,
                'qos' => $qos,
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error('Failed to publish MQTT message', [
                'error' => $e->getMessage(),
                'topic' => $topic,
                'payload' => $payload,
            ]);
            // Mark as disconnected so we try to reconnect next time
            $this->isConnected = false;
            $this->client = null;
            return false;
        }
    }

    public function publishConveyorStart(string $deviceTopic = '6UJaRjVcx1AFd9H6zfNky9DgKG08ix_carwash_esp32'): bool
    {
        $payload = ['conveyor' => 'START'];
        return $this->publish($deviceTopic, $payload);
    }

    public function disconnect(): void
    {
        if ($this->isConnected && $this->client) {
            try {
                $this->client->disconnect();
                Log::info('MQTT client disconnected');
            } catch (Exception $e) {
                Log::error('Error disconnecting MQTT client', [
                    'error' => $e->getMessage(),
                ]);
            }
            $this->isConnected = false;
            $this->client = null;
        }
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function isConnected(): bool
    {
        return $this->isConnected;
    }
}