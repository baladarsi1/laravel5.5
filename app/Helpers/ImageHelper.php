<?php
/**
 * Created by PhpStorm.
 * User: Kamepalli
 * Date: 25/10/18
 * Time: 9:59 AM
 */

function getImageNameFromBrowserRequest($image)
{
    return time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
}