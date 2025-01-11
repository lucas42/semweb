<?php
include("../inc/init.php");
$backend=new Backend("Projects");

$backend->addTitle("The Semantic Web");
$backend->addOutput("<p>I ♥ the Semantic Web.  Here are some ontologies which I've made:<ul>
	<li><a href=\"http://purl.org/theatre\">Theatre Ontology</a></li>
	<li><a href=\"http://purl.org/audience\">Audience Ontology</a> - Very unstable, currently a work in progress.</li>
</ul></p>");

$backend->printit();
