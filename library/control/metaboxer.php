<?php

//via http://www.wproots.com/ultimate-guide-to-meta-boxes-in-wordpress/

add_smart_meta_box('smart_meta_box_quote', array(
'title'     => 'Quote Meta',
'pages'		=> array('post'),
'context'   => 'normal',
'priority'  => 'high',
'fields'    => array(
array(
'name' => 'Quote Author',
'id' => 'quote_author',
'default' => '',
'desc' => 'The name of the author of the quote.',
'type' => 'text',
),array(
'name' => 'Quote Source',
'id' => 'quote_source',
'default' => '',
'desc' => 'The source document of the quote.',
'type' => 'text',
),array(
'name' => 'Quote Link',
'id' => 'quote_link',
'default' => '',
'desc' => 'A hyperlink to the quote, if one exists.',
'type' => 'text',
)
)

));

?>