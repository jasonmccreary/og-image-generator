# OG Image Generator
A simple PHP script to generate OG images.

It uses the _Front Matter_ within Markdown posts (assumes `*.md` files) to generate the OG images and saves them to an _asset_ path. It will also add an `og_image` key to the post _Front Matter_ with a value of the generated OG image filename.

While this script will generate OG images out-of-the-box, you should customize it to suit your needs. For more details on how the script works, you may [watch me build it](https://www.youtube.com/playlist?list=PLmwAMIdrAmK7bIBrMBxEk6ZjmQGzaEEUF). For more details on customizing the OG image, you may review the [underlying package](https://github.com/simonhamp/the-og).

## Usage
```sh
php og-image-generator.php [posts] [assets]
```

### Example
```sh
php og-image-generator.php /path/to/markdown/posts /path/to/save/og/images
```

## Requirements
This package uses [the-og](https://github.com/simonhamp/the-og) from Simon Hamp, which requires the [Imagick PHP extension](https://github.com/Imagick/imagick).
