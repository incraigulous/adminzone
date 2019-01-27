<?php
$page = request()->headers->has('x-layout') ? request()->headers->get('x-layout') : 'layout';
$layout = 'adminzone::layouts.' . $page;
?>
@extends($layout)
