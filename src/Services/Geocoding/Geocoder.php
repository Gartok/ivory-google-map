<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

use Geocoder\Geocoder as BaseGeocoder;

/**
 * Geocoder which describes a google map geocoder.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Geocoder
 * @author GeLo <geloen.eric@gmail.com>
 */
class Geocoder extends BaseGeocoder
{
    /**
     * {@inheritdoc}
     */
    public function geocode($request)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            return $this->getProvider()->getGeocodedData($request);
        }

        return parent::geocode($request);
    }

    /**
     * {@inheritdoc}
     */
    public function placeByAddress($value)
    {
    	if ($this->getProvider() instanceof GeocoderProvider) {
    	    $this->getProvider()->setType('place');
    	}

    	$provider = $this->getProvider()->setMaxResults($this->getMaxResults());
    	$data     = $provider->getGeocodedData(trim($value));

    	return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function placeById($value)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            $this->getProvider()->setType('place_id');
        }

        $provider = $this->getProvider()->setMaxResults($this->getMaxResults());
        $data     = $provider->getGeocodedData(trim($value));

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function placesNearby($value)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            $this->getProvider()->setType('nearby');
        }

        $provider = $this->getProvider()->setMaxResults($this->getMaxResults());
        $data     = $provider->getGeocodedData($value);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function reverse($latitude, $longitude)
    {
        if ($this->getProvider() instanceof GeocoderProvider) {
            $this->getProvider()->setType(null);
            return $this->getProvider()->getReversedData(array($latitude, $longitude));
        }

        return parent::reverse($latitude, $longitude);
    }
}
