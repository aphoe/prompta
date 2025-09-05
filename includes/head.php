<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="<?php echo $description; ?>"
    />
    <meta name="author" content="Afolabi 'aphoe' Legunsen" />
    <meta
      name="keywords"
      content="<?php echo $keywords; ?>"
    />
    <title><?php echo $title; ?></title>
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebApplication",
        "name": "<?php echo $jsonld_name; ?>",
        "description": "<?php echo $jsonld_desc; ?>",
        "url": "https://aphoe.com",
        "author": {
          "@type": "Person",
          "name": "Afolabi 'aphoe' Legunsen"
        },
        "applicationCategory": "DeveloperApplication",
        "operatingSystem": "Web Browser",
        "offers": {
          "@type": "Offer",
          "price": "0",
          "priceCurrency": "USD"
        }
      }
    </script>
