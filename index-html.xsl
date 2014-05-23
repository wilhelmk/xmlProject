<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
<xsl:param name="user_id"/>
<xsl:param name="username"/>
<xsl:output indent="yes" method="html"/>
<xsl:template match="/">
   <html>
     <head>
       <title>Willes och Keffis Drinklista!</title>
     </head>
     <body>
		<center>
		
	<xsl:choose>
		<xsl:when test="$user_id &gt; 0">
		   <a href="login.php">L'a'gg till en drink!</a><br/><br/>
		   Inloggad som:
		   <xsl:value-of select="$username"/><br />
		   <a href="checklogout.php">Logga ut</a><br/><br/>
		</xsl:when>
		<xsl:otherwise>
			Logga in
			<form action="checklogin.php">
			E-mail<br />
			<input type="text" name="email" /><br />
			L'o'senord<br />
			<input type="text" name="password" /><br />

			<button type="submit">Login</button>
			</form>
			Eller <a href="register.php">registrera</a> en ny användare
		</xsl:otherwise>
	</xsl:choose>

       
       
      
      <br /><br /><br />
      <h3>Filtrera</h3>
       <form>
		    <input type="text" name="filter" />
       </form>
       
       
		<xsl:apply-templates select="//drink"/>
       </center>
     </body>
   </html>
</xsl:template>

<xsl:template match="drink">
		<h2><xsl:value-of select="name"/></h2><br/>
		<xsl:if test="$user_id = author/@uid">
			<a href="delete.php?drink_id={@id}">Ta bort</a>
			&#160;&#160;&#160;&#160;
			<a href="delete.php?drink_id={@id}">'A'ndra</a>
		</xsl:if>
		<br />
		<img width="200" height="200" src="{imagelink}"/>
		<h3>Skapare:</h3> <xsl:value-of select="author"/><br/><br/>
		
		<h3>Ingredienser</h3>
		<xsl:for-each select="ingredience">
			<xsl:value-of select="./@amount"/>
			<xsl:text>&#160;</xsl:text>
			<xsl:value-of select="."/><br/>
		</xsl:for-each><br/>
		
		<h3>Beskrivning</h3>
		<xsl:value-of select="description"/><br/><br/><br/>
</xsl:template>

</xsl:stylesheet>
