<?php
declare(strict_types=1);

use DiscordWebhook\DiscordWebhook;
use DiscordWebhook\Messages\{TextMessage, DiscordEmbed};

/**
 * Returns the DiscordWebhook instance.
 *
 * @param string $webhookUrl
 *
 * @return DiscordWebhook
 *
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
function discordWebhook(string $webhookUrl): DiscordWebhook
{
    return new DiscordWebhook($webhookUrl);
}

/**
 * Returns the TextMessage instance.
 *
 * @return TextMessage
 *
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
function discordMessage(): TextMessage
{
    return new TextMessage();
}

/**
 * Returns the DiscordEmbed instance.
 *
 * @return DiscordEmbed
 *
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
function discordEmbed(): DiscordEmbed
{
    return new DiscordEmbed();
}
