<?php
require_once __DIR__ . '/includes/data.php';
$page = findPageByKey($whatPages, 'blister');
$sectionTitle = 'What We Do';
$sectionPages = $whatPages;
$active = 'what';
include __DIR__ . '/includes/inner-template.php';
