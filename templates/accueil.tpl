<div id="news">
    <div id=slider>
        <ul id="listeNews"><!--
            {$i = 0}
            {foreach $last_articles as $article}
            {$i=$i+1}
            --><li rel="0:{$i*300}" id="listeNews-{$i}">
                <h1>{$article->getHTMLName()}</h1>
                    <table>
	                    <tr>
                            <td>
                                <img src="img/articles/{$article->getID()}.png" alt="{$article->getHTMLName()}" title="Nouveauté!!"/>
                            </td>
                            <td>
                                <p>{$article->getHTMLDescription()}</p>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>
                                <a href="index.php?page=article&article={$article->getID()}" title="Voir la fiche de l'article!" class=bouton>&nbspPlus d'infos...</a>
                            </td>
                        </tr>
                    </table>
            </li><!--
			
            {/foreach}
        --></ul>
    </div>					
    <div id="listeNews-menu"><!--
        {$i = 0}
        {foreach $last_articles as $article}
        {$i=$i+1}
        --><a href="#listeNews-{$i}" class=bouton>&nbsp&nbsp{$i}&nbsp&nbsp</a><!--
        {/foreach}
    --></div>	
</div>
