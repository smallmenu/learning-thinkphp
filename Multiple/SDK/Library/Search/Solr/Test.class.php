<?php
namespace SDK\Library\Search\Solr;

use Vendor\Solr\Solr;

class Test extends Solr
{
    protected $core = 'test';

    protected $uniqueKey = 'contentid';

    public function __construct($options = array())
    {
        parent::__construct($options);
    }
}