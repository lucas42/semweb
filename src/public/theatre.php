<?php
include("../inc/backend.php");
$backend=new Backend("Projects",true);
if($backend->extention=="owl")$backend->mimetype="application/rdf+xml";

$data = (object) array(
   'Ontology' => 
  (object) array(
     'blank' => 
    (object) array(
       'comment' => 'A vocabulary for theatrical data.  It defines concepts such as shows, productions, seasons etc.',
       'creator' => 'http://lukeblaney.co.uk/#me',
       'priorVersion' => 'http://bedlamtheatre.co.uk/schema#',
    ),
  ),
   'Class' => 
  (object) array(
     'Production' => 
    (object) array(
       'comment' => 'The realisation of a theatrical work.',
       'subclassof' => 'frbr:Expression',
    ),
     'Season' => 
    (object) array(
       'comment' => 'A collection of Productions and/or Performances',
       'examples' => 'Edinburgh Fringe Festival 2010; Covent Garden Opera Company Season 1964/65',
    ),
     'Position' => 
    (object) array(
       'comment' => 'A set of responibilities.',
       'examples' => 
      array (
        'http://en.wikipedia.org/wiki/Theatre_director' => 'Director',
        'http://en.wikipedia.org/wiki/Composer' => 'Composer',
        0 => 'Assistant Lighting Technician',
      ),
    ),
     'participation:Role' => 
    (object) array(
       'comment' => 'The occupation of a Position by an Agent for a particular Project.',
    ),
     'Venue' => 
    (object) array(
       'comment' => 'A Nestable Spatial Thing used for Theatrical Events.',
       'subclassof' => 'geo:SpatialThing',
       'examples' => 
      array (
        'http://www.fctt.org.uk/festival_theatre/' => 'Edinburgh Festival Theatre',
        'http://www.shakespeares-globe.org/' => 'The Globe',
      ),
    ),
     'Workshop' => 
    (object) array(
       'comment' => 'An event which involves participation, mainly with an educational focus.',
       'subclassof' => 'ev:Event',
    ),
     'Meeting' => 
    (object) array(
       'comment' => 'An event which involves discussion/planning, often with a formal tone.',
       'subclassof' => 'ev:Event',
    ),
     'Rehersal' => 
    (object) array(
       'comment' => 'An event which involves preparatory work for a Performance.',
       'subclassof' => 'ev:Event',
       'status' => 'archaic',
    ),
     'Rehearsal' => 
    (object) array(
       'comment' => 'An event which involves preparatory work for a Performance.',
       'subclassof' => 'ev:Event',
    ),
     'PressNight' => 
    (object) array(
       'subclassof' => 'mo:Performance',
       'comment' => 'A performance which reviewers are encouraged to attend.',
    ),
     'RehersalReading' => 
    (object) array(
       'subclassof' => 'mo:Performance',
       'comment' => 'An unpolished performance in which the cast read from scripts.',
       'status' => 'archaic',
    ),
     'RehearsalReading' => 
    (object) array(
       'subclassof' => 'mo:Performance',
       'comment' => 'An unpolished performance in which the cast read from scripts.',
    ),
     'Portrayal' => 
    (object) array(
       'comment' => 'A Position which involes portraying a Character.',
       'subclassof' => 'Position',
    ),
     'AccessibilityProvision' => 
    (object) array(
       'comment' => 'A Provision which makes an ev:Event more accessible',
       'examples' => 
      array (
        'http://en.wikipedia.org/wiki/British_Sign_Language' => 'BSL signer',
        'http://en.wikipedia.org/wiki/Surtitles' => 'Surtitles',
        'http://en.wikipedia.org/wiki/Audio_description' => 'Audio Description',
      ),
    ),
     'Voice' => 
    (object) array(
       'comment' => 'The voice classification for a Singer or singing part.',
       'subclassof' => 'mo:Instrument',
       'examples' => 
      array (
        'http://en.wikipedia.org/wiki/Soprano' => 'Soprano',
        'http://en.wikipedia.org/wiki/Contralto' => 'Contralto',
        'http://en.wikipedia.org/wiki/Baritone' => 'Baritone',
      ),
    ),
     'ProductionCompany' => 
    (object) array(
       'comment' => 'An Organisation which puts on Productions.',
       'subclassof' => 'foaf:Organization',
       'examples' => 
      array (
        'http://www.eno.org/' => 'English National Opera',
        'http://eutc.org.uk/' => 'Edinburgh University Theatre Company',
        'http://www.cirquedusoleil.com/' => 'Cirque Du Soleil',
      ),
    ),
     'Show' => 
    (object) array(
       'comment' => 'The writing/devising which may enable a Production.',
       'subclassof' => 'frbr:Work',
       'status' => 'archaic',
    ),
     'PerformableProject' => 
    (object) array(
       'comment' => 'A Project which intends to evoke a response from an Audience.',
       'subclassof' => 'foaf:Project',
       'status' => 'archaic',
    ),
  ),
   'ObjectProperty' => 
  (object) array(
     'part_of_season' => 
    (object) array(
       'comment' => 'Indicates that something is part of a season',
       'domain' => 
      array (
        0 => 'Production',
        1 => 'Performance',
        2 => 'Season',
      ),
       'range' => 'Season',
       'transitive' => true,
    ),
     'production_of' => 
    (object) array(
       'comment' => 'Indicates that a Production is an expression of a given work or production.',
       'domain' => 'Production',
       'range' => 
      array (
        0 => 'frbr:Work',
        1 => 'Production',
      ),
    ),
     'position' => 
    (object) array(
       'comment' => 'Associates a Role with a Position.',
       'domain' => 'participation:Role',
       'range' => 'Position',
    ),
     'venue' => 
    (object) array(
       'comment' => 'Associates an Event with the Venue it is held in.',
       'domain' => 'Event',
       'range' => 'Venue',
       'subpropertyof' => 'ev:place',
    ),
     'parent_venue' => 
    (object) array(
       'comment' => 'Associates a Venue with its containing Venue.',
       'domain' => 'Venue',
       'range' => 'Venue',
    ),
     'event' => 
    (object) array(
       'comment' => 'Associates a Project with an Event.',
       'domain' => 'foaf:Project',
       'range' => 'ev:Event',
    ),
     'project' => 
    (object) array(
       'comment' => 'Associates a Role with a Project.',
       'domain' => 'participation:Role',
       'range' => 
      array (
        0 => 'frbr:Work',
        1 => 'Production',
        2 => 'Season',
        3 => 'ev:Event',
      ),
       'inverseOf' => 'credit',
    ),
     'credit' => 
    (object) array(
       'comment' => 'Associates a Project with a Role.',
       'domain' => 
      array (
        0 => 'frbr:Work',
        1 => 'Production',
        2 => 'Season',
        3 => 'ev:Event',
      ),
       'range' => 'participation:Role',
       'inverseOf' => 'project',
       'status' => 'unstable',
    ),
     'portrays' => 
    (object) array(
       'comment' => 'Associates a Portrayal with a Character.',
       'domain' => 'Portrayal',
       'range' => 'omb:Character',
    ),
     'performance' => 
    (object) array(
       'comment' => 'Associates a Production with a Performance.',
       'domain' => 'Production',
       'range' => 'Performance',
       'subpropertyof' => 'event',
       'inverseOf' => 'performance_of',
    ),
     'performance_of' => 
    (object) array(
       'comment' => 'Associates a Production with a Performance.',
       'domain' => 'Performance',
       'range' => 'Production',
       'inverseOf' => 'performance',
    ),
     'put_on_by' => 
    (object) array(
       'domain' => 'Production',
       'range' => 'ProductionCompany',
       'comment' => 'The Company which puts on a Production',
    ),
     'sponsor' => 
    (object) array(
       'domain' => 
      array (
        0 => 'Production',
        1 => 'Performance',
      ),
       'range' => 'foaf:Agent',
       'comment' => 'The Person or Organisation who sponsors a given production or performance',
    ),
     'audience_restriction' => 
    (object) array(
       'domain' => 'Performance',
       'range' => 'xsd:string',
       'comment' => 'A restriction on who can attend a particular performance',
       'examples' => 'Schools only performance; Adult Audience Only',
    ),
     'time_of_day' => 
    (object) array(
       'domain' => 'Performance',
       'range' => 'xsd:string',
       'comment' => 'A human readable indication of when in the day a performance occurs',
       'examples' => 'Matinée; Evening Performance; Morning Matinée',
    ),
     'accessibility_provision' => 
    (object) array(
       'domain' => 'ev:Event',
       'range' => 'AccessibilityProvision',
       'comment' => 'Associates an Accessibility Provision with an Event',
    ),
     'recorded_for' => 
    (object) array(
       'domain' => 'mo:Performance',
       'range' => 'po:Broadcast',
       'comment' => 'A performance recorded for either Simulcast or later broadcast.',
    ),
     'genre' => 
    (object) array(
       'domain' => 'frbr:Work',
       'range' => 'mo:Genre',
       'comment' => 'Associates a Genre with a Work.',
       'examples' => 
      array (
        'http://en.wikipedia.org/wiki/Opera' => 'Opera',
        'http://en.wikipedia.org/wiki/Improvisational_theatre' => 'Imrov Comedy',
        'http://en.wikipedia.org/wiki/Pantomime' => 'Panto',
        'http://en.wikipedia.org/wiki/Interpretive_dance' => 'Interpretative Dance',
      ),
    ),
     'based_on' => 
    (object) array(
       'domain' => 'frbr:Work',
       'range' => 'frbr:Work',
       'comment' => 'Indicates a Work that another Work was based on .',
       'examples' => 'The Ballet of Romeo and Juliet by Prokofiev is based on the play of the same name by Shakespeare.',
    ),
     'scored_voice' => 
    (object) array(
       'domain' => 'omb:Character',
       'range' => 'Voice',
       'comment' => 'Indicates the voice classification that a particular Operatic character has been written for.',
       'examples' => '',
    ),
     'premiere' => 
    (object) array(
       'domain' => 
      array (
        0 => 'Production',
      ),
       'range' => 'mo:Performance',
       'comment' => 'Indicates the first performance of a Show or Production in a particular area.',
       'status' => 'unstable',
    ),
     'worldPremiere' => 
    (object) array(
       'domain' => 
      array (
        0 => 'Production',
      ),
       'range' => 'mo:Performance',
       'comment' => 'Indicates the first performance of a Show or Production on a particular planet.',
       'subpropertyof' => 'premiere',
       'status' => 'unstable',
    ),
     'production' => 
    (object) array(
       'comment' => 'Associates a Season with a Production.',
       'domain' => 'Season',
       'range' => 'Production',
       'status' => 'archaic',
    ),
     'manifestation' => 
    (object) array(
       'comment' => 'Associates a Performableproject with a Production.',
       'domain' => 'Performableproject',
       'range' => 'Production',
       'status' => 'archaic',
    ),
     'primary_season' => 
    (object) array(
       'comment' => 'Associates a production with its commissioning season.',
       'domain' => 'Production',
       'range' => 'Season',
       'status' => 'archaic',
    ),
     'parent_season' => 
    (object) array(
       'domain' => 'Season',
       'range' => 'Season',
       'status' => 'archaic',
       'comment' => 'Associates a season with its commissioning season.',
    ),
     'agent' => 
    (object) array(
       'comment' => 'Associates a Role with an Agent.',
       'domain' => 'participation:Role',
       'range' => 'foaf:Agent',
       'sameas' => 'participation:holder',
       'status' => 'archaic',
    ),
  ),
);

if($backend->mimetype!="application/rdf+xml"){
	$backend->addTitle("Theatre Ontology");
	$backend->addText("An ontology for organising theatrical data.");
	$backend->addOutput("<img src=\"theatre-schema\" alt=\"\" class=\"blockimg\"/>");
}
$rootxmlns="http://purl.org/theatre#";
include('../inc/ont.inc');

