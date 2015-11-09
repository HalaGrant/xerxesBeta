<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<title>
					Reviews from Popyoular
				</title>
			</head>

			<body>
				<xsl:for-each select="aggregated-review/reviews/review">
					<div onmouseover="this.style.backgroundColor='#E8F2F7'"
						onmouseout="this.style.backgroundColor='#FFFFFF'">
						<div style="border-top:#000 dotted 1px; height:5px;">
						</div>

						<div style="float:right; width:100%; font-size:12px;">

							<xsl:for-each select="quotes/quote/by">

								<xsl:value-of select="self::node()" />
								@
							</xsl:for-each>




							<xsl:for-each select="review-source/name">
								<xsl:value-of select="self::node()" />
							</xsl:for-each>

						</div>
						score


						<xsl:for-each select="display-score">

							<xsl:value-of select="self::node()" />
						</xsl:for-each>



						<xsl:for-each select="quotes/quote/text">
							<div
								style="float:none; clear:both; padding-left:25px; padding-bottom:2px;padding-top:10px;">

								<i>
									<xsl:value-of select="self::node()" />
								</i>
							</div>
						</xsl:for-each>
					</div>
				</xsl:for-each>
			</body>
		</html>
	</xsl:template>

</xsl:stylesheet>