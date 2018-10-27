<?php

namespace App\Services\BOC\Subscriptions;

use App\Services\BOC\BOCUrlFactory;

class Accounts {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    public function __construct(BOCUrlFactory $urls)
    {

        $this->urls = $urls;
    }

}
