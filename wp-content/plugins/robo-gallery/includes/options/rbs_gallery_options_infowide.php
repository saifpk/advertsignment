<?php 
/*
*      Robo Gallery     
*      Version: 1.0
*      By Robosoft
*
*      Contact: https://robosoft.co/robogallery/ 
*      Created: 2015
*      Licensed under the GPLv2 license - http://opensource.org/licenses/gpl-2.0.php
*
*      Copyright (c) 2014-2018, Robosoft. All rights reserved.
*      Available only in  https://robosoft.co/robogallery/ 
*/

if ( ! defined( 'ABSPATH' ) ) exit;

$infowide_group = new_cmb2_box( array(
    'id'            => ROBO_GALLERY_PREFIX.'infowide_metabox',
    'title'         => '<span class="dashicons dashicons-cart"></span> '.__('Get Pro version','robo-gallery'),
    'object_types'  => array( ROBO_GALLERY_TYPE_POST ),
    'context'       => 'normal',
));

$infowide_group->add_field( array(
    'id'            => ROBO_GALLERY_PREFIX.'infoWide',
    'type'          => 'title',
    'before_row'    => '<div class="rbs_infoblock">'
    						.'<div class="rbs_infoSmall rbs_getproversion_blank">'.__( 'with PRO version you get more advanced functionality and even more flexibility in settings' , 'robo-gallery' ).'</div>'
    					.'</div>'
));