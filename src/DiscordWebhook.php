<?php
declare(strict_types=1);

namespace DiscordWebhook;

use DiscordWebhook\Messages\TextMessage;
use DiscordWebhook\Error\DiscordWebhookException;

use function strlen;
use function curl_init;
use function curl_setopt_array;
use function curl_exec;
use function curl_error;
use function json_encode;
use function json_decode;
use function usleep;

use const CURLOPT_POST;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_SSL_VERIFYPEER;
use const CURLINFO_HTTP_CODE;

/**
 * Class DiscordWebhook
 *
 * @package DiscordWebhook
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
final readonly class DiscordWebhook
{
    private string $webhookUrl;

    /**
     * DiscordWebhook Constructor.
     *
     * @param string $webhookUrl
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function __construct(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    /**
     * Sends the message to the Discord webhook.
     *
     * @param TextMessage $message
     * @param int $maxRetries
     *
     * @return void
     * @throws DiscordWebhookException
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function send(TextMessage $message, int $maxRetries = 3): void
    {
        $isSent = false;
        $retryCount = 0;

        if (strlen($this->webhookUrl) === 0) {
            throw DiscordWebhookException::noWebhook();
        }

        if (!$message->isValid()) {
            throw DiscordWebhookException::noContent();
        }

        $options = [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_POSTFIELDS => json_encode($message),
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
        ];

        $curl = curl_init($this->webhookUrl);
        curl_setopt_array($curl, $options);

        while (!$isSent && $retryCount < $maxRetries) {
            $response = curl_exec($curl);

            if ($response === false) {
                throw DiscordWebhookException::curlError(curl_error($curl));
            }

            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($statusCode === 429) {
                $retryCount++;

                $response = json_decode($response, true);

                usleep($response["retry_after"] * 1000);
            } elseif ($statusCode >= 200 && $statusCode < 300) {
                $isSent = true;
            } else {
                throw DiscordWebhookException::invalidStatus($statusCode);
            }
        }

        curl_close($curl);
    }
}
