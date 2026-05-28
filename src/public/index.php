<?php

$title = "Luke's Semantic Web";
$canonical = getenv('APP_ORIGIN') . '/';
include("../inc/header.php");

print "<p>I ♥ the Semantic Web.  Here are some ontologies which I've made:<ul>
	<li><a href=\"/theatre\">Theatre Ontology</a></li>
	<li><a href=\"/audience\">Audience Ontology</a> - Very unstable, currently a work in progress.</li>
</ul></p>";

include("../inc/footer.php");