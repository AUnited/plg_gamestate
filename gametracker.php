<?php
# @ 2016 Vitaliy Zhukov. All rights reserved. GNU/GPL v3 licence

# Assert file included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

#GameTracker Content Plugin
class plgContentGameTracker extends JPlugin
{
	function PluginGameTracker( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onContentPrepare ( $context, &$article, &$params, $page = 0)
		{
		global $mainframe;

		if ( JString::strpos( $article->text, '{gametracker}'))
		{
            $article->text = preg_replace_callback('|{gametracker}(.*){\/gametracker}|',function ($match){return $this->GameBigBanner($match[1]);}, $article->text);
        }
		return true;
	}

	function GameBigBanner($sAddr)
    {
		return '<a href="http://www.gametracker.com/server_info/'.$sAddr.'/" target="_blank"><img src="http://cache.www.gametracker.com/server_info/'.$sAddr.'/b_560_95_1.png" border="0" width="560" height="95" alt="'.$sAddr.' Big banner"/></a>';
    }

    function GameBanner($sAddr)
    {
        #var init
        $params = $this->params;

        $color = $params->get('style350', 'custom'); //color preset
        $top_color = $params->get('topc350', '692108');
        $font_color = $params->get('btmc350', 'FFFFFF');
        $bottom_color = $params->get('fntc350', '381007');
        $border_color = $params->get('bdrc350', '000000');

        #logic
    switch ($color)
        {
        case 'red':
            $image = 'b_350_20_692108_381007_FFFFFF_000000.png';
            break;
        case 'orange':
            $image = 'b_350_20_FFAD41_E98100_000000_591F11.png';
            break;
        case 'green':
            $image = 'b_350_20_5A6C3E_383F2D_D2E1B5_2E3226.png';
            break;
        case 'blue':
            $image = 'b_350_20_323957_202743_F19A15_111111.png';
            break;
        case 'custom':
            $image = 'b_350_20_'.$top_color.'_'.$bottom_color.'_'.$font_color.'_'.$border_color.'.png';
            break;
        }
            return '<a href="http://www.gametracker.com/server_info/'.$sAddr.'/" target="_blank"><img src="http://cache.www.gametracker.com/server_info/'.$sAddr.'/'.$image.'" border="0" width="350" height="20" alt="GT '.$sAddr.' '.$color.' game banner"/></a>';
    }

    function GameBlock($sAddr)
    {
        #var init
        $params = $this->params;

        $color = $params->get('style160', 'gray');
        $font_color = $params->get('fntc160', '#ffffff');
        $font_color = ltrim($font_color, "#");
        $font_color = strtolower($font_color);
        $title_color = $params->get('ttlc160', '#c5c5c5');
        $title_color = ltrim($title_color, "#");
        $title_color = strtolower($title_color);
        $name_color = $params->get('namec160', '#ffffff');
        $name_color = ltrim($name_color, "#");
        $name_color = strtolower($name_color);
        $bg_color = $params->get('bgdc160', '#ffffff');
        $bg_color = ltrim($bg_color, "#");
        $bg_color = strtolower($bg_color);
        $player_graph = $params->get('plgraph160', '1');
        $top_players = $params->get('pltop160', '1');
        $map_screenshot = $params->get('mapscr160', '1');
        $image='';

        #logic
        $height = 182; // wight = 160
        if($player_graph) $height += 66;
        if($top_players) $height += 82;
        if($map_screenshot) $height += 106;
        $height = settype($height, "string");

        switch ($color) {
            case 'custom': //color id = 0
                $image = 'b_160_400_0_'.$font_color.'_'.$title_color.'_'.$name_color.'_'.$bg_color.'_'.$map_screenshot.'_'.$player_graph.'_'.$top_players.'.png';
                break;
            case 'gray': //color id = 1
                $image = 'b_160_400_1_ffffff_c5c5c5_ffffff_000000_'.$map_screenshot.'_'.$player_graph.'_'.$top_players.'.png';
                break;
            case 'red': //color id = 2
                $image = 'b_160_400_2_ffffff_c5c5c5_ff9900_000000_'.$map_screenshot.'_'.$player_graph.'_'.$top_players.'.png';
                break;
        }
        return '<a href="http://www.gametracker.com/server_info/'.$sAddr.'/" target="_blank"><img src="http://cache.www.gametracker.com/server_info/'.$sAddr.'/'.$image.'" border="0" width="160" height="'.$height.'" alt=""/></a>/></a>';
    }

    function GameHtmlBlock($sAddr)
    {
        #var init
        $params = $this->params;

        $color = $params->get('color', 'gray');
        $bg_color = $params->get('color', '#333333');
        $bg_color = ltrim($bg_color, "#");
        $bg_color = strtoupper($bg_color);

        $font_color = $params->get('color', '#cccccc');
        $font_color = ltrim($font_color, "#");
        $font_color = strtoupper($font_color);

        $title_bg_color = $params->get('color', '#222222');
        $title_bg_color = ltrim($title_bg_color, "#");
        $title_bg_color = strtoupper($title_bg_color);

        $title_color = $params->get('color', '#ff9900');
        $title_color = ltrim($title_color, "#");
        $title_color = strtoupper($title_color);

        $border_color = $params->get('color', '#555555');
        $border_color = ltrim($border_color, "#");
        $border_color = strtoupper($border_color);

        $link_color = $params->get('color', '#ffcc00');
        $link_color = ltrim($link_color, "#");
        $link_color = strtoupper($link_color);

        $border_link_color = $params->get('color', '#222222');
        $border_link_color = ltrim($border_link_color, "#");
        $border_link_color = strtoupper($border_link_color);

        $wight = $params->get('color', 240);
        $map_screenshot = $params->get('color', '1');
        $online_players = $params->get('color', '1');
        $online_players_height = $params->get('color', 100);
        $top_players = $params->get('color', '1');
        $top_players_height = $params->get('color', 100);
        $blog = $params->get('color', '1');
        $option='';

        #logic
        if($wight < 144) $wight =144; // min sizes
        if($online_players_height < 100) $online_players_height = 100;
        if($top_players_height < 100) $online_players_height = 100;

        $height = 164;
        if($map_screenshot) $height += 124;
        if($top_players) $height += 24 + $top_players_height;
        if($online_players) $height += 24 + $online_players_height;
        if($blog) $height += 124;
        $height = settype($height, "string");

        switch ($color) {
            case 'custom':
                $option = '&bgColor='.$bg_color.'&fontColor='.$font_color.'&titleBgColor='.$title_bg_color.'&titleColor='.$title_color.'&borderColor='.$border_color.'&linkColor='.$link_color.'&borderLinkColor='.$border_link_color.'&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
            case 'gray':
                $option = '&bgColor=333333&fontColor=CCCCCC&titleBgColor=222222&titleColor=FF9900&borderColor=555555&linkColor=FFCC00&borderLinkColor=222222&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
            case 'blue':
                $option = '&bgColor=1F2642&fontColor=8790AE&titleBgColor=11172D&titleColor=FFFFFF&borderColor=333333&linkColor=FF9900&borderLinkColor=999999&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
            case 'orange':
                $option = '&bgColor=FF9900&fontColor=000000&titleBgColor=FF7700&titleColor=000000&borderColor=000000&linkColor=06126A&borderLinkColor=FF7700&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
            case 'white':
                $option = '&bgColor=FFFFFF&fontColor=333333&titleBgColor=FFFFFF&titleColor=000000&borderColor=BBBBBB&linkColor=091858&borderLinkColor=5C5C5C&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
            case 'camo':
                $option = '&bgColor=373E28&fontColor=D2E1B5&titleBgColor=2E3225&titleColor=FFFFFF&borderColor=3E4433&linkColor=889C63&borderLinkColor=828E6B&showMap='.$map_screenshot.'&currentPlayersHeight='.$online_players_height.'&showCurrPlayers='.$online_players.'&topPlayersHeight='.$top_players_height.'&showTopPlayers='.$top_players.'&showBlogs='.$blog.'&width='.$wight;
                break;
        }
        return '<iframe src="http://cache.www.gametracker.com/components/html0/?host='.$sAddr.$option.'" frameborder="0" scrolling="no" width="'.$wight.'" height="'.$height.'"></iframe>';
    }
}
