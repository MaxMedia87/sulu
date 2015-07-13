<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Component\Content\Document\Behavior;

interface BlameBehavior
{
    /**
     * @return mixed
     */
    public function getCreator();

    /**
     * @return mixed
     */
    public function getChanger();
}