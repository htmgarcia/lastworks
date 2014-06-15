<?php
/**
 * @autor       Valentín García
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2014 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Import library to get working JHtml elements (like <img>, <a> tags)
jimport( 'joomla.html.html' );

// Load CSS
JHtml::stylesheet( Juri::base() . 'modules/mod_lastworks/assets/css/style.css' );

// Main container. To add Module class suffix in this container, add the PHP var $moduleclass_sfx
echo '<div class="lastworks-container lastworks-one-column">';

    if(count($articles)) {

        foreach($articles as $article) {//<-- ARTICLE LOOP.
    
            $images = json_decode($article->images);
            $category = modLastWorksHelper::getCategoryLW( $article->catid );
        
            echo '<div class="lastworks-row row-fluid">
                <div class="lastworks-item span12">';
            
                    // Title of the article
                    echo '<h3>' . $article->title . '</h3>';
                
                    // Category of the article
                    /*echo '<ul class="breadcrumb">
                        <li>' . JText::_('JCATEGORY') . ': ' . JHtml::_('link', ContentHelperRoute::getCategoryRoute($article->catid), $category) . '</li>
                    </ul>';*/
                
                    // Intro image of the article. display image only when exist in the Article >> Images & Links >> Intro Image
                    if( $images->image_intro ){
                        echo JHtml::_('image', Juri::base() . $images->image_intro, 'alt="' . $article->title . '"' );
                    }
                    
                    // Intro Text of the article
                    echo $article->introtext;
                
                    // Read more link
                    echo '<p>' . JHtml::_('link', ContentHelperRoute::getArticleRoute($article->id), JText::_('MOD_LASTWORKS_READMORE', $article->catid), 'class="btn"') . '</p>'; 
            
                echo '</div>
            </div>';
            
        }//.ARTICLE LOOP -->
        
    }else{
        echo '<div class="alert alert-block">' . JText::_('MOD_LASTWORKS_NO_ARTICLES_FOUND') . '</div>';
    }

echo '</div>';