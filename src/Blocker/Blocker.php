<?php

namespace app\Blocker;

use Symfony\Component\HttpFoundation;

interface Blocker
{
    /**
     * @return HttpFoundation\Response
     */
    public function block();
}
