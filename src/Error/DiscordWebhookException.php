<?php
declare(strict_types=1);

namespace DiscordWebhook\Error;

use Exception;
use Throwable;
use JetBrains\PhpStorm\Pure;

use function sprintf;

/**
 * Class DiscordWebhookException
 *
 * @package DiscordWebhook\Error
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
final class DiscordWebhookException extends Exception
{
    /**
     * DiscordWebhookException Constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    #[Pure]
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns a no webhook exception.
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public static function noWebhook(): self
    {
        return new self("No webhook URL was provided. Please provide a valid webhook URL.");
    }

    /**
     * Returns an invalid status exception.
     *
     * @param int $status
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public static function invalidStatus(int $status): self
    {
        return new self(sprintf("Discord responded with [HTTP %s] status code", $status));
    }

    /**
     * Returns a curl error exception.
     *
     * @param string $error
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public static function curlError(string $error): self
    {
        return new self($error);
    }

    /**
     * Returns a no content exception.
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public static function noContent(): self
    {
        return new self("No message content or embed(s) provided.");
    }
}
