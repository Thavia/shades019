<?php
/**
 * GIT DEPLOYMENT SCRIPT
 *
 * Used for automatically deploying websites via github or bitbucket, more deets here:
 *
 *      https://gist.github.com/1809044
 */

// The commands
$commands = array(
    'echo $PWD',
    'whoami',
    //   'git checkout prod',
    //   'git pull origin prod',
    'git status',
    //  'cd ../..',
);
if ( array_key_exists('branch' , $_GET) && ($_GET['branch'] != null) ) {
    $branch = $_GET['branch'];
    $commands[] = sprintf("git checkout %s",$branch);
    $commands[] = sprintf("git pull origin %s",$branch);
}

// Run the commands for output
$output = '';
foreach($commands AS $command){
    // Run it
    $tmp = shell_exec($command);
    // Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
}
// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT :)</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>

<?php echo $output; ?>
</pre>
</body>
</html>