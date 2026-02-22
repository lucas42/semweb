<?php
class Backend
{
	private $output = "";
	public $uri;
	public $noext;
	public $subpage;
	public $subsubpage;
	public $rdfavail;
	public $pdfavail;
	public $mimetype;
	public $charset;
	public $title;
	public $navpage;
	public $extention;

	function __construct($navpage = null, $rdfavail = false, $pdfavail = false)
	{
		$this->uri = $_SERVER['REQUEST_URI'];
		if (strpos($this->uri, "."))
			$this->noext = substr($this->uri, 0, strpos($this->uri, "."));
		else
			$this->noext = $this->uri;
		$pages = explode('/', trim($this->uri, '/'));
		$this->subpage = (count($pages) > 1) ? $pages[1] : null;
		$this->subsubpage = (count($pages) > 2) ? $pages[2] : null;
		$type = "";
		if (isset($_SERVER['PATH_INFO']))
			$type = substr($_SERVER['PATH_INFO'], 1);
		$this->extention = $type;
		$conq = "application/xhtml+xml,text/html";
		$this->rdfavail = $rdfavail;
		$this->pdfavail = $pdfavail;
		if ($this->rdfavail)
			$conq = "application/rdf+xml, " . $conq;
		switch ($type) {
			case "xml":
				$this->mimetype = "application/xml";
				break;
			case "xhtml":
				$this->mimetype = "application/xhtml+xml";
				break;
			case "html":
				$this->mimetype = "text/html";
				break;
			case "rdf":
				$this->mimetype = "application/rdf+xml";
				break;
			case "rss":
				$this->mimetype = "application/rss+xml";
				break;
			case "pdf":
				$this->mimetype = "application/pdf";
				break;
			case "ajax":
				$this->mimetype = "application/ajax+xml";
				break;
			default:
				$this->mimetype = 'text/html';
		}
		$this->charset = "UTF-8";
		$this->title = "Luke's Semantic Web";
		$this->navpage = $navpage;
	}
	function addTitle($title, $hh = 1, $url = null, $clear = false)
	{
		$style = $clear ? " style=\"clear:both\"" : "";
		$id = "";
		if ($hh) {
			$this->addOutput("<h{$hh}{$id}{$style}>");
			if ($url)
				$this->addOutput("<a href=\"" . htmlspecialchars($url) . "\">");
			$this->addText($title);
			if ($url)
				$this->addOutput("</a>");
			$this->addOutput("</h{$hh}>");
		}
		if ($hh < 2)
			$this->title .= " | " . $title;
	}
	function addOutput($output, $tag = null)
	{
		if ($tag)
			$this->output .= "\n<" . $tag . ">";
		$this->output .= $output;
		if ($tag)
			$this->output .= "</" . $tag . ">";
	}
	function addText($text, $tag = null)
	{
		$this->addOutput(htmlspecialchars($text), $tag);
	}
	function printit()
	{
		header("Content-Type: {$this->mimetype};charset={$this->charset}\n\n");
		$title = $this->title;
		if ($this->mimetype == "application/xhtml+xml" || $this->mimetype == "text/html")
			include("header.php");
		print $this->output;
		if ($this->mimetype == "application/xhtml+xml" || $this->mimetype == "text/html")
			include("footer.php");
		exit;
	}
}