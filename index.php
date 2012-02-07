<?php
// Get the cached likes (which have been pulled from Facebook using cron.php)
$companies = @unserialize(@file_get_contents(dirname(__FILE__) . '/cache.txt'));

// Fallback if cache could not be retrieved
if (!$companies) { require_once(dirname(__FILE__) . '/cron.php'); }

// Debug output
header('Content-Type: text/plain; charset=utf-8');
print_r($companies);