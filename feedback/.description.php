<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => Loc::GetMessage("OSMINOJKA_FEEDBACK_NAME"),
    "DESCRIPTION" => Loc::GetMessage("OSMINOJKA_FEEDBACK_DESC"),
    "PATH" => array(
        "ID" => "dws",
        "NAME" => Loc::GetMessage("OSMINOJKA_GROUP_NAME"),
    ),
);