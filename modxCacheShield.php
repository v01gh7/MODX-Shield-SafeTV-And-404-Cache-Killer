<?php
/**
 * Name: SafeTV + Disable404Cache
 * Events: OnWebPageInit, OnLoadWebDocument, OnWebPagePrerender
 */

if (!($modx instanceof modX)) return;

switch ($modx->event->name) {

    case 'OnWebPageInit':
        // SafeTV — prevent errors when $modx->resource is missing
        if (!$modx->resource) {
            $modx->setPlaceholder('safetv_bypass', true);

            // Override getTVValue to return empty string
            $modx->getTVValue = function($tvName) {
                return '';
            };

            // For Fenom templates
            if (class_exists('pdoFetch') && method_exists('pdoFetch', 'addFenomModifier')) {
                pdoFetch::addFenomModifier('tv', function($value, $tv) {
                    return '';
                });
            }
        }
        break;

    case 'OnLoadWebDocument':
        if ($modx->resource) {
            $errorPageId = (int) $modx->getOption('error_page');
            if ($modx->resource->get('id') === $errorPageId) {
                $modx->resource->set('cacheable', false);
            }
        }
        break;

    case 'OnWebPagePrerender':
        if (http_response_code() === 404 && $modx->resource) {
            $modx->resource->set('cacheable', false);
        }
        break;
}
