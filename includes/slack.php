<?php
# file used as an include
# This will notify a slack channel of a members win.
# because people have different slack, epic, console names,
# it calls the image generator with the *slack* name, so people know who won

require '../vendor/autoload.php';

function slackNotify($slackname, $playername){

	// Instantiate without defaults
	$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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');

	$settings = [
		'username' 			=> 'Fortnite.wang',
		'channel' 			=> '#fortnite',
		'link_names' 		=> true,
  	'unfurl_links' 	=> true,
		'unfurl_media'	=> true
	];

	$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
	$client->send("@here @$slackname had a #1 Victory Royale!\n https://earlgreyders.wang/newsite/winrar.php?playername=$slackname&place=1");
}
?>
