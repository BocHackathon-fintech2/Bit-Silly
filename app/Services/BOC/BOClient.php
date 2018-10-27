<?php

namespace App\Services\BOC;

use App\Services\BOC\Subscriptions\Accounts;
use App\Services\BOC\Subscriptions\Authorization;
use App\Services\BOC\Subscriptions\Payments;
use App\Services\BOC\Subscriptions\Subscription;

class BOClient {

    /**
     * @var BOCUrlFactory
     */
    private $urls;

    public function __construct(BOCUrlFactory $urls) {

        $this->urls = $urls;
    }

    public function authorization() {

        return new Authorization($this->urls);
    }

    public function accounts() {

        return new Accounts($this->urls);

    }

    public function payments() {

        return new Payments($this->urls);

    }

    public function subscriptions() {

        return new Subscription($this->urls);

    }
}
