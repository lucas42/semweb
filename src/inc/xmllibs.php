<?php

$xmlns = [
   'dc' => 'http://purl.org/dc/elements/1.1/',
   'dcterms' => 'http://purl.org/dc/terms/',
   'ev' => 'http://purl.org/NET/c4dm/event.owl#',
   'foaf' => 'http://xmlns.com/foaf/0.1/',
   'frbr' => 'http://purl.org/vocab/frbr/core#',
   'geo' => 'http://www.w3.org/2003/01/geo/wgs84_pos#',
   'mo' => 'http://purl.org/ontology/mo/',
   'po' => 'http://purl.org/ontology/po/',
   'owl' => 'http://www.w3.org/2002/07/owl#',
   'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
   'rdfs' => 'http://www.w3.org/2000/01/rdf-schema#',
   'thea' => 'http://purl.org/theatre#',
   'event' => 'http://purl.org/NET/c4dm/event.owl#',
   'xsd' => 'http://www.w3.org/2001/XMLSchema#',
   'participation' => 'http://purl.org/vocab/participation/schema#',
   'time' => 'http://www.w3.org/2006/time#',
   'omb' => 'http://purl.org/ontomedia/ext/common/being#',
   'vs' => 'http://www.w3.org/2003/06/sw-vocab-status/ns#',
];

function print_rdf_head($rootxmlns) {
	global $backend, $xmlns;
	$backend->addOutput('<?xml version="1.0" encoding="utf-8"?>'."\n");
	$backend->addOutput("<rdf:RDF\n");
	foreach($xmlns as $label=>$url){
		$backend->addOutput( "\txmlns:$label=\"$url\"\n");
	}
	$backend->addOutput("\txmlns=\"$rootxmlns\" xml:base=\"$rootxmlns\">\n");
}
function print_rdf_foot() {
	global $backend;
	$backend->addOutput("</rdf:RDF>");
	$backend->printit();

}
