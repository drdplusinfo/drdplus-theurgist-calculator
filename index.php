<?php
namespace DrdPlus\Theurgist\Formulas;

use DrdPlus\Calculators\Theurgist\FormulaDirs;
use DrdPlus\CalculatorSkeleton\CalculatorController;

\error_reporting(-1);
if ((!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '127.0.0.1') || PHP_SAPI === 'cli') {
    \ini_set('display_errors', '1');
} else {
    \ini_set('display_errors', '0');
}
$documentRoot = $documentRoot ?? (PHP_SAPI !== 'cli' ? \rtrim(\dirname($_SERVER['SCRIPT_FILENAME']), '\/') : \getcwd());

/** @noinspection PhpIncludeInspection */
require_once $documentRoot . '/vendor/autoload.php';

$dirs = $dirs ?? new FormulaDirs($documentRoot);
$htmlHelper = $htmlHelper ?? \DrdPlus\RulesSkeleton\HtmlHelper::createFromGlobals($dirs);
if (PHP_SAPI !== 'cli') {
    \DrdPlus\RulesSkeleton\TracyDebugger::enable($htmlHelper->isInProduction());
}

$configuration = $configuration ?? \DrdPlus\CalculatorSkeleton\CalculatorConfiguration::createFromYml($dirs);
$servicesContainer = $servicesContainer ?? new \DrdPlus\Calculators\Theurgist\FormulaServicesContainer($configuration, $htmlHelper);

/** @noinspection PhpUnusedLocalVariableInspection */
$controller = $controller ?? new CalculatorController($servicesContainer);

/** @noinspection PhpIncludeInspection */
require $dirs->getVendorRoot() . '/drdplus/calculator-skeleton/index.php';
