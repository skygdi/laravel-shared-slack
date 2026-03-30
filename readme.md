# Slack Dashboard Package

A simple Laravel package for sending Slack notifications and viewing them in a dashboard.

## Installation

```bash
composer require skygdi/slack
```


## Features

* Send Slack messages from Laravel
* Log informational messages
* Use a default Slack channel from `.env`
* Simple dashboard route for viewing package output

## Environment Variables

Add these values to your `.env` file:

```env
SLACK_BOT_TOKEN=xoxb-your-token
SLACK_DEFAULT_CHANNEL=sanmar
SLACK_ROLE=Worker2
```

### Variables

* `SLACK_BOT_TOKEN`
  Your Slack bot token.

* `SLACK_DEFAULT_CHANNEL`
  The default Slack channel name to send messages to.

* `SLACK_ROLE`
  The worker or role name that will appear in messages.

## Usage

### Example

```php
use Skygdi\Slack\SlackGate;

SlackGate::info('SanMar DIP import raw variants finished', [
    'total_rows' => $totalRows,
]);
```

### Example Output

This sends an info message to Slack with extra context data.

## Dashboard

Visit:

```text
/slack_dashboard
```

to access the dashboard.

## Basic Example

```php
SlackGate::info('Import finished', [
    'total_rows' => 1200,
    'source' => 'SanMar',
]);
```

## Suggested Use Cases

* import completed
* import failed
* background job status
* webhook activity
* sync finished
* warning or error reporting

## Notes

* Make sure your Slack bot has permission to post in the target channel.
* Make sure the channel exists and the bot has been added to it.
* Keep your Slack bot token private and never commit it to source control.

## Security

Do not commit real `.env` values to GitHub or any public repository.

Use this in your `.env.example` instead:

```env
SLACK_BOT_TOKEN=
SLACK_DEFAULT_CHANNEL=
SLACK_ROLE=
```
