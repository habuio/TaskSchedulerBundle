<?php
$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->exclude('Tests')
    ->in(__DIR__)
;
return PhpCsFixer\Config::create()
    ->setRules(array(
        '@Symfony' => true,
    ))
    ->setFinder($finder)
    ;