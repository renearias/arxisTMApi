<?php

namespace AppBundle\Twig\Extension;

class Base64Extension extends \Twig_Extension
{
    /**
     * Get Base64 value
     *
     * @param string $value Link value
     * @return string
     */
    public function base64Filter($value)
    {
        return urlencode(base64_encode($value));
    }
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('url64', array($this, 'base64Filter')),
        );
    }
     /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Arxis url64 Filter Extension';
    }
}
