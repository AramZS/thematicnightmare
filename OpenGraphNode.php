<?php

/* OpenGraphNode.php
 * =================
 *
 * AUTHOR
 *
 *     Toby Inkster <http://tobyinkster.co.uk/>.
 *
 * USAGE
 *
 *     # Fetch and parse a URL
 *     $page = new OpenGraphNode($url);
 *
 *     # Get the page title as a string
 *     print $page->title . "\n";     ## PHP 5+ only
 *     print $page->title() . "\n";   ## PHP 5+ only
 *     print $page->Get('title') . "\n";
 *
 *     # Or as an array (in case of multiple titles)
 *     $titles = $page->title(1);     ## PHP 5+ only
 *     $titles = $page->Get('title', 1);
 *
 *     # Get an array like key=>value
 *     $all = $page->All();
 *
 *     # Get an array like key=>array(values)
 *     $all = $page->All(1);
 *
 *     # General RDFa is also parsed
 *     $data = $page->RDFa();
 *
 * LICENCE
 *
 *      Choose your favourite of:
 *      <http://www.gnu.org/licenses/gpl-3.0.html>
 *      <http://www.gnu.org/licenses/gpl-2.0.html>
 *      <http://www.w3.org/Consortium/Legal/2002/copyright-software-20021231>
 *
 * SUPPORT / WARRANTY
 *
 *      This program is distributed in the hope that it
 *      will be useful, but WITHOUT ANY WARRANTY; without
 *      even the implied warranty of MERCHANTABILITY or
 *      FITNESS FOR A PARTICULAR PURPOSE.
 *
 *      For support, try the OGP developers' mailing list
 *      <http://groups.google.com/group/open-graph-protocol>.
 */

include 'arc/ARC2.php';

class OpenGraphNode
{
	var $_rdfa_parser;
	var $_data = array();
	
	function OpenGraphNode ($u)
	{
		$this->_rdfa_parser = ARC2::getSemHTMLParser();
		$this->_rdfa_parser->parse($u);
		$this->_rdfa_parser->extractRDF('rdfa');
		$index = $this->_rdfa_parser->getSimpleIndex(0);
		
		foreach ($index[$u] as $prop => $values)
		{
			$matches = array();
			if (preg_match('#^http://opengraphprotocol.org/schema/(.+)$#i', $prop, &$matches))
				$p = strtolower($matches[1]);
			else
				$p = $prop;
			
			foreach ($values as $value)
			{
				if ($value['type'] == 'bnode') continue;
				$this->_data[$p][] = $value['value'];
			}
		}
		
		return $this;
	}
	
	function RDFa ($flatten=1)
	{
		return $this->_rdfa_parser->getSimpleIndex($flatten);
	}
	
	function All ($arrays=0)
	{
		if ($arrays)
			return $this->_data;
		
		$rv = array();
		foreach ($this->_data as $prop => $values)
		{
			$rv[$prop] = $values[0];
		}
		return $rv;
	}
	
	function __get ($name)
	{
		$name = str_replace('_', '-', $name);
		return $this->Get($name, 0);
	}
	
	function Get($name, $array=0)
	{
		if (!isset($this->_data[$name]))
			return $array ? array() : null;
		
		return $array ? $this->_data[$name] : $this->_data[$name][0];
	}
	
	function __call($name, $args)
	{
		$name = str_replace('_', '-', $name);
		return $this->Get($name, isset($args[0])?$args[0]:null);
	}
}
