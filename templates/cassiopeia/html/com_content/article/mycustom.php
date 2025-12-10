<?php

    $url = "https://pure.iiasa.ac.at/cgi/exportview/iiasa/161/RSS2/161.xml";

    $rss = simplexml_load_file($url);

    if (!$rss) {
        die("Failed to load RSS feed");
    }

    // Loop through items
    $a = 1;
    foreach ($rss->channel->item as $i=>$item) {
        $doiLink = "";
        $desc = html_entity_decode((string)$item->description);
        $title = trim((string)$item->title);

        if (preg_match('/https:\/\/doi\.org\/[^\s<"]+/', $desc, $match)) {
            $doiLink = $match[0];
        }
        $desc = preg_replace('/ORCID:\s*https?:\/\/orcid\.org\/[^\s<]+/i', '', $desc);

        echo "<div style='margin-bottom:10px;'>";
        if ($doiLink != "") {
            echo "<h5><a href='{$doiLink}' target='_blank'>{$title}</a></h5>";
        } else {
            echo "<h5>{$title}</h5>";
        }

        // Description
        if (!empty($item->description)) {

        echo "<p>($desc)</p>";

        }

       

        echo "</div><hr>";
    }
?>