<?php

function parse_rdf($realname,$value){
    	$name=htmlspecialchars($realname);
    	$insert = null;
    	if(isset($value->toplevel) && !empty($value->about)){
		$insert=" rdf:about=\"".htmlspecialchars($value->about)."\"";
	}
	if(isset($value->toplevel) && !empty($value->type))$name=$value->type;
	switch($name){
		case "Production":case "PerformableProject":case "Show":case "Season":case "Position":case "Role":case "Venue":case "Workshop":case "SeasonType":case "ProductionType":case "CommitteePosition":case "Character": case "Rehersal": case "Meeting": case "Portrayal":
    			$name="thea:".$name;
	    		if(!$value->toplevel && !$insert)$insert=" rdf:parseType='Resource'";
    			break;
    		case "Agent": case "Project":
    			$name="foaf:".$name;
	    		if(!$insert)$insert=" rdf:parseType='Resource'";
    		break;
    		case "Event":
    			$name="ev:".$name;
	    		if(!$insert)$insert=" rdf:parseType='Resource'";
    		break;
    		case "Work":
    			$name="frbr:".$name;
	    		if(!$insert)$insert=" rdf:parseType='Resource'";
    		break;
    		case "Performance":
    			$name="mo:".$name;
	    		if(!$insert)$insert=" rdf:parseType='Resource'";
    		break;
    		case "Interval": case "Instant":
    			$name="time:".$name;
	    		if(!$insert)$insert=" rdf:parseType='Resource'";
    		break;
    		case "production_of": case "manifestation": case "position": case "parent_venue": case "event": case "performance": case "primary_season": case "productionType": case "seasonType": case "parent_season": case "project": case "agent": case "season": case "venue": case "portrayal-of": case "time_of_day":
	    		$name="thea:".$name;
    			break;
    		case "name": case "venue_name": case "season_name":
    			$name="foaf:name";
    		break;
    		case "title": case "description":
    			$name="dc:".$name;
    		break;
    		case "genre":
    			$name="mo:".$name;
    		break;
    		case "notes": case "season_notes":
    			$name="dc:descripton";
    		break;
    		case "information_source":
    			$name="dc:source";
    		break;
    		case "time":
    			$name="ev:".$name;
    		break;
    		case "start": case "end":
    			$name="timeline:".$name;
	    		if(!$insert)$insert=" rdf:datatype=\"http://www.w3.org/2001/XMLSchema#dateTime\"";
    		case "inXSDDateTime":
    			$name="time:".$name;
	    		if(!$insert)$insert=" rdf:datatype=\"http://www.w3.org/2001/XMLSchema#dateTime\"";
    		break;
    		case "priref":case "production_priref":case "work_priref":case "performance_priref":case"work_title":case "scope":case "title_sortname":case "record_type":case "status":case "toplevel":case "about":case "performance_status": case "type": case "venue_id": case "season_priref":
    			return;
    	}
    	$spaceloc=stripos($name," ");
	if($spaceloc)$endname=substr($name,0,$spaceloc);
	else $endname=$name;
	if(!empty($value->about) && !isset($value->toplevel)){
		return "<$name rdf:resource=\"".htmlspecialchars($value->about)."\" />\n";
        }
        $out = "<$name{$insert}>";
        if (is_object($value)){
        	foreach($value as $key => $val) {
        		$out .= "\n".parse_rdf($key, $val);
        	}
        }
        else if($value)
            $out .= htmlspecialchars($value);
        else return;
        $out .= "</$endname>\n";
        return $out;
}

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
