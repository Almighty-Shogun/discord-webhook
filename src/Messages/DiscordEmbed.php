<?php
declare(strict_types=1);

namespace DiscordWebhook\Messages;

use Override;
use JetBrains\PhpStorm\{ArrayShape, Pure};

use function date;
use function hexdec;
use function str_replace;

/**
 * Class DiscordEmbed
 *
 * @package DiscordWebhook\Messages
 * @since 1.0.0
 * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
 */
final class DiscordEmbed extends DiscordMessage
{
    protected ?int $color = null;
    protected ?string $url = null;
    protected ?string $title = null;
    protected ?string $image = null;
    protected array $fields;
    protected ?string $timestamp = null;
    protected ?string $thumbnail = null;
    protected ?string $authorURL = null;
    protected ?string $footerIcon = null;
    protected ?string $authorName = null;
    protected ?string $footerText = null;
    protected ?string $authorIcon = null;
    protected ?string $description = null;

    /**
     * DiscordEmbed Constructor.
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    #[Pure]
    public function __construct()
    {
        $this->fields = [];
    }

    /**
     * Sets the color of the embed.
     *
     * @param string $color
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setColor(string $color): self
    {
        $this->color = hexdec(str_replace("#", "", $color));

        return $this;
    }

    /**
     * Sets the URL of the embed.
     *
     * @param string $url
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Sets the title of the embed.
     *
     * @param string $title
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Sets the description of the embed.
     *
     * @param string $description
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Sets the image of the embed.
     *
     * @param string $image
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Adds a field to the embed.
     *
     * @param string $name
     * @param string $value
     * @param bool $inline
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function addField(string $name, string $value, bool $inline = false): self
    {
        $this->fields = [...$this->fields, [
            "name" => $name,
            "value" => $value,
            "inline" => $inline
        ]];

        return $this;
    }

    /**
     * Sets the timestamp of the embed.
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setTimestamp(): self
    {
        $this->timestamp = date("c");

        return $this;
    }

    /**
     * Sets the thumbnail of the embed.
     *
     * @param string $thumbnail
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Sets the author of the embed.
     *
     * @param string|null $author
     * @param string|null $icon
     * @param string|null $url
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setAuthor(?string $author = null, ?string $icon = null, ?string $url = null): self
    {
        $this->authorURL = $url;
        $this->authorIcon = $icon;
        $this->authorName = $author;

        return $this;
    }

    /**
     * Sets the footer of the embed.
     *
     * @param string|null $text
     * @param string|null $icon
     *
     * @return self
     *
     * @since 1.0.0
     * @author Almighty Shogun <alm1ghtyshogun1998@gmail.com>
     */
    public function setFooter(?string $text = null, ?string $icon = null): self
    {
        $this->footerText = $text;
        $this->footerIcon = $icon;

        return $this;
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
        "title" => "string|null",
        "description" => "string|null",
        "timestamp" => "string|null",
        "url" => "string|null",
        "color" => "int|null",
        "author" => "array",
        "image" => "string|null",
        "thumbnail" => "string|null",
        "fields" => "array",
        "footer" => "array"
    ])]
    public function toArray(): array
    {
        return [
            "title" => $this->title,
            "description" => $this->description,
            "timestamp" => $this->timestamp,
            "url" => $this->url,
            "color" => $this->color,
            "author" => [
                "name" => $this->authorName,
                "url" => $this->authorURL,
                "icon_url" => $this->authorIcon
            ],
            "image" => [
                "url" => $this->image
            ],
            "thumbnail" => [
                "url" => $this->thumbnail
            ],
            "fields" => $this->fields,
            "footer" => [
                "text" => $this->footerText,
                "icon_url" => $this->footerIcon
            ]
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
        "title" => "string|null",
        "description" => "string|null",
        "timestamp" => "string|null",
        "url" => "string|null",
        "color" => "int|null",
        "author" => "array",
        "image" => "string|null",
        "thumbnail" => "string|null",
        "fields" => "array",
        "footer" => "array"
    ])]
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
