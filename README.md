<a href="https://shogun.ms" target="_blank" rel="noopener">
	<img src="https://cdn.shogun.ms/assets/branding/app-icon-256.svg" alt="Shogun app-icon" height="62"/>
</a>

---

# DiscordWebhook
Personal implementation of Discord webhooks for PHP.

## 📃 Prerequisites
- **[PHP](https://www.php.net/)**: >= v8.3
- Extension `ext-curl` enabled in the `php.ini` file.

## 💻 Installation

### Step 1
Install the library via composer:
```shell
composer require almighty-shogun/discord-webhook
```

### Step 2
Use the library in your project.

**Using the classes**
```php
<?php

use DiscordWebhook\DiscordWebhook;
use DiscordWebhook\Error\DiscordWebhookException;
use DiscordWebhook\Messages\{TextMessage, DiscordEmbed};

$discordWebhook = new DiscordWebhook("https://discord.com/api/webhooks/xxx/xxxx");

// Text message
$message = new TextMessage();
$embed = new DiscordEmbed();

$embed->setTitle("Test Embed")
    ->setDescription("This is a test embed.")
    ->setColor("#228b22") // Hex color code without the # symbol.
    ->setURL("https://github.com/Almighty-Shogun")
    ->setFooter("Test Footer", "https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setTimestamp()
    ->setThumbnail("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setImage("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setAuthor("Almighty Shogun", "https://avatars.githubusercontent.com/u/96011415?v=4")
    ->addField("Field 1", "This is a test field.")
    ->addField("Field 2", "This is another test field.")
    ->addField("Field 3", "This is a third test field.");

$textMessage->setUsername("Almighty Shogun")
    ->setAvatar("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setContent("This is a test message.");

try {
    $discordWebhook->send($textMessage);
} catch (DiscordWebhookException $e) {
    echo $e->getMessage();
}
```

**Using the helper functions**
```php
<?php

$discordWebhook = discordWebhook("https://discord.com/api/webhooks/xxx/xxxx");

$embed = discordEmbed()->setTitle("Test Embed")
    ->setDescription("This is a test embed.")
    ->setColor("228b22") // Hex color code without the # symbol.
    ->setURL("https://github.com/Almighty-Shogun")
    ->setFooter("Test Footer", "https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setTimestamp()
    ->setThumbnail("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setImage("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setAuthor("Almighty Shogun", "https://avatars.githubusercontent.com/u/96011415?v=4")
    ->addField("Field 1", "This is a test field.")
    ->addField("Field 2", "This is another test field.")
    ->addField("Field 3", "This is a third test field.");

$textMessage = discordMessage()
    ->setUsername("Almighty Shogun")
    ->setAvatar("https://avatars.githubusercontent.com/u/96011415?v=4")
    ->setContent("This is a test message.")
    ->addEmbed($embed);

try {
    $discordWebhook->send($textMessage);
} catch (DiscordWebhookException $e) {
    echo $e->getMessage();
}
```
