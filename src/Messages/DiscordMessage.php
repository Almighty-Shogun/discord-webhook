<?php
declare(strict_types=1);

namespace DiscordWebhook\Messages;

use Override;
use JsonSerializable;

/**
 * Class DiscordMessage
 *
 * @package DiscordWebhook\Messages
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 *
 * @internal
 * @private
 */
abstract class DiscordMessage implements JsonSerializable
{
    /**
     * Returns an array representation of the message.
     *
     * @return array
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    abstract public function toArray(): array;

    /**
     * {@inheritDoc}
     *
     * @return array
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    #[Override]
    abstract public function jsonSerialize(): array;
}
