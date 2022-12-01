# Social Share Links ![Statamic 3](https://img.shields.io/badge/statamic-3-blue.svg?style=flat-square)

> Easily configure and add social sharing links to your ****Statamic**** site.

## Features

This following channels are currently supported:

- Facebook
- WhatsApp
- Twitter
- LinkedIn

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require osayaweventures/share-links
```

## Publish the view

``` bash
php artisan vendor:publish --tag="share-links-views"
```

## How to Use

- In the Statamic Control Panel, click on the **Share Links** option under **Tools**. Next, toggle the buttons to enable or disable specific channel.
- Use the `{{ share_links }}` tag where you want the buttons to appear

### Supported tags 

The following tags are support:

```
{{ share_links:dump }}
```

**OUTPUT:**
```
[
  "facebook" => "https://www.facebook.com/sharer/sharer.php?u=urlencoded"
  "twitter" => "https://twitter.com/intent/tweet?url=urlencoded"
  "linkedin" => "https://www.linkedin.com/shareArticle?mini=true&url=urlencoded"
  "whatsapp" => "https://api.whatsapp.com/send?text=urlencoded"
]
```

#### Generate Facebook Link

```
{{ share_links:facebook }} 
```

#### Generate LinkedIn Link

```
{{ share_links:linkedin }} 
```

> Below are the og: tags that must exist and their correct format for LinkedIn:

```
<meta property='og:title' content='Title of the article'/>
<meta property='og:image' content='//media.example.com/ 1234567.jpg'/>
<meta property='og:description' content='Description that will show in the preview'/>
<meta property='og:url' content='//www.example.com/URL of the article'/>
```

#### Generate Twitter Link
```
{{ share_links:twitter text="Post to twitter" handle="10gurusolutions" hashtags="elonmusk,statamic" related=""}}
```

#### Generate WhatsApp Link

```
{{ share_links:whatsapp }} 
```
