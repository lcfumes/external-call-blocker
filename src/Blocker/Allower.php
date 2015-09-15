<?php

namespace app\Blocker;

use Symfony\Component\HttpFoundation;

interface Allower
{
    /**
     * @param HttpFoundation\Request $request
     *
     * @return bool
     */
    public function isAllowed(HttpFoundation\Request $request);
}
