<?php
require_once("conneg.php");
class Backend{
	private $output;
	function __construct($navpage=null,$rdfavail=false,$pdfavail=false) {
		$this->uri=$_SERVER['REQUEST_URI'];
		if(strpos($this->uri,"."))$this->noext=substr($this->uri,0,strpos($this->uri,"."));
		else $this->noext=$this->uri;
		$pages = explode('/', trim($this->uri, '/'));
		$this->subpage = (count($pages) > 1)?$pages[1]:null;
		$this->subsubpage = (count($pages) > 2)?$pages[2]:null;
		//$this->subpage=substr($this->noext,strrpos($this->noext,"/")+1);
		//$this->subpage=substr($this->uri,strrpos($this->uri,"/")+1);
		//if(strpos($this->subpage,"."))$this->subpage=substr($this->subpage,0,strpos($this->subpage,"."));
		$this->extention=substr($this->uri,strrpos($this->uri,".")+1);
		$conq="application/xhtml+xml,text/html";
		$this->rdfavail=$rdfavail;
		$this->pdfavail=$pdfavail;
		if($this->rdfavail)$conq="application/rdf+xml, ".$conq;
		$conneg = new contentNegotiation();
		switch($this->extention){
			case "xml":
				$this->mimetype="application/xml";
			break;
			case "xhtml":
				$this->mimetype="application/xhtml+xml";
			break;
			case "html":
				$this->mimetype="text/html";
			break;
			case "rdf":
				$this->mimetype="application/rdf+xml";
			break;
			case "rss":
				$this->mimetype="application/rss+xml";
			break;
			case "pdf":
				$this->mimetype="application/pdf";
			break;
			case "ajax":
				$this->mimetype="application/ajax+xml";
			break;
			default:

				// If its IE,  then ignore what it tells us, because it lies.  Just send it html
				if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
					$this->mimetype = 'text/html';
					break;
				}
				$this->mimetype=trim($conneg->compareQ($conq));
		}
		$this->charset="UTF-8";
		$this->title="Luke Blaney";
		$this->navpage=$navpage;
		$this->lang=$conneg->compareQ('en,ga', 'language');
		file_put_contents ('/srv/lukeblaney.co.uk/tmplog', $_SERVER['HTTP_ACCEPT']."|{$this->extention}|{$this->mimetype}\n", FILE_APPEND);
		file_put_contents ('/srv/lukeblaney.co.uk/tmplang', $_SERVER['HTTP_ACCEPT_LANGUAGE']."|{$this->lang}\n", FILE_APPEND);
	}
	function addTitle($title,$hh=1,$url=null,$clear=false){
		if($clear)$style=" style=\"clear:both\"";
		if($hh){
			$this->addOutput("<h{$hh}{$id}{$style}>");
			if($url)$this->addOutput("<a href=\"".htmlspecialchars($url)."\">");
			$this->addText($title);
			if($url)$this->addOutput("</a>");
			$this->addOutput("</h{$hh}>");
		}
		if($hh<2)$this->title.=" | ".$title;
	}
	function addOutput($output,$tag=null){
		if($tag)$this->output.="\n<".$tag.">";
		$this->output.=$output;
		if($tag)$this->output.="</".$tag.">";
	}
	function addText($text,$tag=null){
		$this->addOutput(htmlspecialchars($text),$tag);
	}
	function addWarning($text){
		$this->addOutput("<div class=\"warning\">");
		$this->addText($text);
		$this->addOutput("</div>");
	}
	function redirect($url){
		header("Status: 301 Moved");
		if(stripos($url,"://")===false)$url="http://".$_SERVER['HTTP_HOST'].$url;
		header("Location: ".$url);
		exit;
	}
	function printit(){
		header("Content-Type: {$this->mimetype};charset={$this->charset}\n\n");
		if ($this->mimetype=="application/xhtml+xml"||$this->mimetype=="text/html")$this->printhtml();
		else print $this->output;
		exit;
	}
	/*function addRawHead($output){
		$this->rawhead.=$output;
	}*/
	function addCanonical($url){
		$this->links.="\n\t<link rel=\"canonical\" href=\"".htmlspecialchars($url)."\" />";
	}
	function printhtml(){
		$title=htmlspecialchars($this->title);
		if ($this->mimetype=="application/xhtml+xml")print"<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		print"\n<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
<title>{$title}</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"/style\" />";
if($this->rdfavail)print "\n<link rel=\"alternate\" type=\"application/rdf+xml\" href=\"{$this->noext}.rdf\" /> ";
if($this->pdfavail)print "\n<link rel=\"alternate\" type=\"application/pdf\" href=\"{$this->noext}.pdf\" /> ";
print $this->links;
print "\n<link rel=\"shortcut icon\" type=\"image/png\" href=\"/img/favicon\" /> ";
//print $this->rawhead;
print "\n</head>
<body>
	<header><span id=\"me\"><a href=\"/\"><img src=\"/img/logo\" alt=\"Luke 
Blaney\" /></a></span><span id=\"about\"></span>
	<nav id=\"mainnav\">
		<ul>";
		global $links;
		foreach($links as $link){
			if($link->text==$this->navpage)$class=" class=\"currentpage\"";
			else unset($class);
			if(!$link->external)$link->href="/".$link->href;
			print "\n\t\t\t<li{$class}><a href=\"".htmlspecialchars($link->href)."\" title=\"".htmlspecialchars($link->title)."\">".htmlspecialchars($link->text)."</a></li>";
		}
		print"
		</ul>
	</nav>
	</header>
	<div id=\"content\">\n";
		print $this->output;
		print"
		<span id=\"end\" />
	</div>
	<footer>
		<nav><ul>
			<li><a rel=\"me\" href=\"http://www.facebook.com/lucas42\" title=\"For people who know me\">Facebook</a></li>
			<li><a rel=\"me\" href=\"http://twitter.com/lucas42\" title=\"For people who want to know me\">Twitter</a></li>
			<li><a rel=\"me\" href=\"http://www.linkedin.com/in/lukeblaney\" title=\"For people who want to employ me\">LinkedIn</a></li>
			<li><a rel=\"me\" href=\"https://hachyderm.io/@lucas42\">Mastodon</a></li>
		</ul></nav>
	</footer>";
if($this->pdfavail)print "\n<a href=\"{$this->noext}.pdf\" id=\"also\">This page is also available as a pdf</a>";
elseif($this->rdfavail)print "\n<a href=\"{$this->noext}.rdf\" id=\"also\">This page is also available as rdf</a>";
print "\n</body>
</html>";
	}
}
