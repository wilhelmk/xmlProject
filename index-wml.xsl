<?xml version="1.0"?>

   <xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:rss="http://purl.org/rss/1.0/"
                version="1.0"
		exclude-result-prefixes="xsl rdf rss">
   
<xsl:output method="xml" 
	doctype-public="-//WAPFORUM//DTD WML 1.1//EN" 
	media-type="text/vnd.wap.wml" 
	doctype-system="http://www.wapforum.org/DTD/wml_1.1.xml" 
	indent="yes" /> 
	
  <xsl:template match="/">
    <wml>
      <xsl:apply-templates select="//drink"/>
    </wml>
  </xsl:template>

	<xsl:template match="drink">
		<center>
		
			<h1><xsl:value-of select="name"/></h1>
			<h2>Skapare</h2>
			<xsl:value-of select="author"/>
			
			<h2>Ingredienser</h2>
			<xsl:for-each select="ingredience">
			<xsl:value-of select="./@amount"/>
			<xsl:text>&#160;</xsl:text>
			<xsl:value-of select="."/><br/>
			</xsl:for-each><br/>
		
			<h2>Beskrivning</h2>
			<xsl:value-of select="description"/>
			<br/><br/><br/><br/>
			</center>
  </xsl:template>


</xsl:stylesheet>


