<?php
include("../inc/backend.php");
$backend=new Backend("Projects",true);
if($backend->extention=="owl")$backend->mimetype="application/rdf+xml";

$data = (object) array(
   'Ontology' => 
  (object) array(
     'blank' => 
    (object) array(
       'comment' => 'A vocabulary for linking audiences to Entertainment',
       'creator' => 'http://lukeblaney.co.uk/#me',
    ),
  ),
   'Class' => 
  (object) array(
     'Entertainment' => 
    (object) array(
       'comment' => 'A distinct creation intended to be consumed by an audience',
    ),
     'po:Episode' => 
    (object) array(
       'subclassof' => 'Entertainment',
    ),
     'thea:Production' => 
    (object) array(
       'subclassof' => 'Entertainment',
    ),
     'mo:MusicalWork' => 
    (object) array(
       'subclassof' => 'Entertainment',
    ),
     'EntertainmentEvent' => 
    (object) array(
       'comment' => 'An Event in which an audience can consume Entertainment',
       'subclassof' => 'event:Event',
    ),
     'po:Broadcast' => 
    (object) array(
       'subclassof' => 'EntertainmentEvent',
    ),
     'mo:Performance' => 
    (object) array(
       'subclassof' => 'EntertainmentEvent',
    ),
     'Audience' => 
    (object) array(
       'comment' => 'The group of agents who consumed Entertainment at an EntertaimentEvent',
       'subclassof' => 'foaf:Group',
    ),
     'AudienceFigure' => 
    (object) array(
       'comment' => 'An attempt to measure the number of people in an Audience',
    ),
  ),
   'ObjectProperty' => 
  (object) array(
     'audience' => 
    (object) array(
       'comment' => 'Associates an Entertainment Event with its Audience',
       'domain' => 'EntertainmentEvent',
       'range' => 'Audience',
       'subpropertyof' => 'dcterms:audience',
    ),
     'consumed' => 
    (object) array(
       'comment' => 'Associates an Agent with Entertainment that they have consumed.',
       'domain' => 'foaf:Agent',
       'range' => 'Entertainment',
    ),
     'figure' => 
    (object) array(
       'comment' => 'Associates an Audience Figure with an Audience',
       'domain' => 'Audience',
       'range' => 'AudienceFigure',
    ),
     'size' => 
    (object) array(
       'comment' => 'The measured size of an Audience',
       'domain' => 'AudienceFigure',
       'range' => 'xsd:integer',
    ),
     'source' => 
    (object) array(
       'comment' => 'The source for an Audience Figure',
       'domain' => 'AudienceFigure',
       'range' => 'foaf:Document',
    ),
     'audienceMember' => 
    (object) array(
       'comment' => 'Relates an Audience to an Agent who is a member of that Audience',
       'domain' => 'Audience',
       'range' => 'foaf:Agent',
       'subpropertyof' => 'foaf:member',
    ),
     'eventOf' => 
    (object) array(
       'comment' => 'Relates an Entertainment Event to the instance of Entertainment',
       'domain' => 'EntertainmentEvent',
       'range' => 'Entertainment',
    ),
     'mo:performance_of' => 
    (object) array(
       'subpropertyof' => 'eventOf',
    ),
  ),
);

if($backend->mimetype!="application/rdf+xml"){
	$backend->addTitle("Audience Ontology");
	$backend->addText("NB: This whole ontolgy is highly unstable for now.  Any feedback is appreciated.","p");
	$backend->addOutput("<img src=\"audience-schema\" alt=\"Schema Diagram\" style=\"max-width:100%\"/>");
}
$rootxmlns="http://purl.org/audience#";
include('../inc/ont.inc');
