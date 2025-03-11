<?php

declare(strict_types=1);

namespace App\Helpers;

class CertificatesHelper
{
    public function buildResponseCertificates($certificates) {
        $route = route('certificates');
        foreach ($certificates->meta->links as $link) {
            if($link->url != null)
                $link->url = str_replace($certificates->meta->path, $route, $link->url);
        }
        $certificates->links->first = str_replace($certificates->meta->path, $route, $certificates->links->first);
        $certificates->links->last = str_replace($certificates->meta->path, $route, $certificates->links->last);
        $certificates->links->prev = str_replace($certificates->meta->path, $route, $certificates->links->prev);
        $certificates->links->next = str_replace($certificates->meta->path, $route, $certificates->links->next);
        $certificates->meta->path = $route;
        return $certificates;
    }
}
