<?php
require_once __DIR__ . '/includes/data.php';
$page = findPageByKey($whoPages, 'quality');
$sectionTitle = 'Who We Are';
$sectionPages = $whoPages;
$active = 'who';
include __DIR__ . '/includes/inner-template.php';
