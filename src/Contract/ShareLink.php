<?php

namespace Osayaweventures\ShareLinks\Contract;

interface ShareLink
{

    /**
     * Generate a sharable link for the channel
     */
    public function links() :array;
}
