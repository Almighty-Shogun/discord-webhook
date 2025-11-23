<?php
declare(strict_types=1);

namespace DiscordWebhook\Messages;

use Override;
use JetBrains\PhpStorm\{ArrayShape, Pure};

/**
 * Class TextMessage
 *
 * @package DiscordWebhook\Messages
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
final class TextMessage extends DiscordMessage
{
    protected bool $tts;
    protected ?string $avatar = null;
    protected ?string $username = null;
    protected ?string $content = null;
    /* @var DiscordEmbed[] */
    protected array $embeds;

    /**
     * TextMessage Constructor.
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function __construct()
    {
        $this->tts = false;
        $this->embeds = [];
    }

    /**
     * Sets the TTS flag.
     *
     * @param bool $tts
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setTts(bool $tts): self
    {
        $this->tts = $tts;

        return $this;
    }

    /**
     * Adds an embed to the message.
     *
     * @param DiscordEmbed $embed
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function addEmbed(DiscordEmbed $embed): self
    {
        $this->embeds = [...$this->embeds, $embed];

        return $this;
    }

    /**
     * Clears all embeds from the message.
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function clearEmbeds(): self
    {
        $this->embeds = [];

        return $this;
    }

    /**
     * Sets the content of the message.
     *
     * @param string $content
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Sets the username of the message.
     *
     * @param string $username
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Sets the avatar of the message.
     *
     * @param string $avatar
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Checks if the message is valid.
     *
     * @return bool
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function isValid(): bool
    {
        return $this->content !== null || !empty($this->embeds);
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    #[Pure]
    #[Override]
    #[ArrayShape([
        "tts" => "bool",
        "content" => "string|null",
        "username" => "string|null",
        "avatar_url" => "string|null",
        "embeds" => "array"
    ])]
    public function toArray(): array
    {
        return [
            "tts" => $this->tts,
            "content" => $this->content,
            "username" => $this->username,
            "avatar_url" => $this->avatar,
            "embeds" => $this->embeds
        ];
    }

    /**
     * {@inheritDoc}
     *
     * @return array
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    #[Pure]
    #[Override]
    #[ArrayShape([
        "tts" => "bool",
        "content" => "string|null",
        "username" => "string|null",
        "avatar_url" => "string|null",
        "embeds" => "array"
    ])]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
