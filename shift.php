<?php

// Generate Open Graph images for blog posts
// underneath the `posts` directory and save
// them in the `assets` directory. Also update
// the Front Matter with the `og_image` filename.
//
// php og-generator.php [posts] [assets]

require 'vendor/autoload.php';

use SimonHamp\TheOg\Image;
use Spatie\YamlFrontMatter\YamlFrontMatter;

if ($argc !== 3) {
    echo 'Usage: php og-generator.php [posts] [assets]'.PHP_EOL;
    exit(1);
}

$path = rtrim($argv[1], '/');

$posts = glob($path.'/*.md');
foreach ($posts as $post) {
    $contents = file_get_contents($post);
    $frontMatter = YamlFrontMatter::parse($contents);

    $read_time = 11; // TODO: Calculate read time
    $filename = basename($post, '.md');
    $url = 'https://blog.laravelshift.com/'.$filename;
    $filename .= '-og.png';

    echo 'Generating: '.$filename.PHP_EOL;

    (new Image)
        ->layout((new \MyOg\ShiftLayout)->setCategory($frontMatter->category)->setReadTime($read_time))
        ->backgroundColor('#ffffff')
        ->accentColor('#0000aa')
        ->watermark(__DIR__.'/assets/logo-shift.svg')
        ->url($url)
        ->title(substr($frontMatter->title, 0, 20))
        ->save($argv[2].$filename);

    exit;

    if ($frontMatter->matter('og_image')) {
        $contents = preg_replace(
            '/og_image: (\S+)/',
            'og_image: '.$filename,
            $contents
        );
    } else {
        $contents = preg_replace('/^date: /m', 'og_image: '.$filename.PHP_EOL.'date: ', $contents, 1);
    }

    file_put_contents($post, $contents);
}
