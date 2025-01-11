<?php

$xmlns->dc="http://purl.org/dc/elements/1.1/";
$xmlns->dcterms="http://purl.org/dc/terms/";
$xmlns->ev="http://purl.org/NET/c4dm/event.owl#";
$xmlns->foaf="http://xmlns.com/foaf/0.1/";
$xmlns->frbr="http://purl.org/vocab/frbr/core#";
$xmlns->geo="http://www.w3.org/2003/01/geo/wgs84_pos#";
$xmlns->mo="http://purl.org/ontology/mo/";
$xmlns->po="http://purl.org/ontology/po/";
$xmlns->owl="http://www.w3.org/2002/07/owl#";
$xmlns->rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#";
$xmlns->rdfs="http://www.w3.org/2000/01/rdf-schema#";
$xmlns->thea="http://purl.org/theatre#";
$xmlns->event="http://purl.org/NET/c4dm/event.owl#";
$xmlns->xsd="http://www.w3.org/2001/XMLSchema#";
$xmlns->participation="http://purl.org/vocab/participation/schema#";
$xmlns->time="http://www.w3.org/2006/time#";
$xmlns->omb="http://purl.org/ontomedia/ext/common/being#";
$xmlns->vs="http://www.w3.org/2003/06/sw-vocab-status/ns#";

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
