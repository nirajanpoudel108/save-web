<?php

    $url = "https://pure.iiasa.ac.at/cgi/exportview/iiasa/161/RSS2/161.xml";

    $rss = simplexml_load_file($url);

    if (!$rss) {
        die("Failed to load RSS feed");
    }

    // Loop through items
    $a = 1;
    foreach ($rss->channel->item as $i=>$item) {
        $a++;
        echo "<div style='margin-bottom:10px;'>";
        echo "<h5><a href='{$item->link}' target='_blank'>{$item->title}</a></h5>";

        // Description
        if (!empty($item->description)) {
            $raw = html_entity_decode($item->description);

        $desc = preg_replace_callback(
                '/<(https?:\/\/[^>]+)>/',
                    function ($m) {
                        $url = $m[1];
                        return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
                },
                $raw
            );

        echo "<p>$desc</p>";

        }

       

        echo "</div><hr>";
    }
?>