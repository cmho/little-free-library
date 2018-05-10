<?php

namespace App;

register_taxonomy('media_tag', 'attachment', array(
    'label' => 'Tags',
    'hierarchical' => false,
));
