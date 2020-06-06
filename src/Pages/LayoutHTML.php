<?php declare(strict_types=1);

namespace Src\Pages;

use Src\Pages\Interfaces\LayoutInterface;

class LayoutHTML implements LayoutInterface
{
    public function showHeaderHtml(string $breadcrumbs): void
    {
        echo '<!DOCTYPE html>
                <html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR">
                <head>
                
                  <meta charset="utf-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                  <title>E-Store Hoplon</title>
                
                 <link rel="shortcut icon" href="http://www.hoplon.com/site/img/img-hoplon-brand.png">
                 <link rel="stylesheet" type="text/css" href="style.css">
                
                </head>
                <body>
                
                    <div id="header">
                            <img src="http://www.hoplon.com/site/img/logo-hoplon.svg"/>
                            <h1>E-Store</h1>
                    </div>
                
                    <div id="crambs">
                        <span>'.$breadcrumbs.'</span>
                        <span class="admin"><a href="admin.php">Admin</a>
                    </div>';
    }

    public function showFooterHTML(): void
    {
        echo '</body>
            
                <script type="text/javascript" src="app.js"></script>
                
                </html>';
    }

    public function startContent(): void
    {
        echo '<div id="content">';
    }

    public function endContent(): void
    {
        echo '<div>';
    }
}