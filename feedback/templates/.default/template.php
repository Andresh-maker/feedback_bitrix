<?php

use Bitrix\Main\Localization\Loc;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->addExternalJS("https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp");
?>
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px]">
        <form id="form-tailwind" method="POST">
            <div class="mb-5">
                <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    <?= Loc::getMessage('TEMPLATE_NAME'); ?>
                </label>
                <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="<?= Loc::getMessage('PLACE_TEMPLATE_NAME'); ?>"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                        for="email"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    <?= Loc::getMessage('TEMPLATE_EMAIL'); ?>
                </label>
                <input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="<?= Loc::getMessage('PLACE_TEMPLATE_EMAIL'); ?>"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                        for="phone"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    <?= Loc::getMessage('TEMPLATE_PHONE'); ?>
                </label>
                <input
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="<?= Loc::getMessage('PLACE_TEMPLATE_PHONE'); ?>"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                />
            </div>
            <div class="mb-5">
                <label
                        for="message"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    <?= Loc::getMessage('TEMPLATE_COMMENT'); ?>
                </label>
                <textarea
                        rows="4"
                        name="message"
                        id="message"
                        placeholder="<?= Loc::getMessage('PLACE_TEMPLATE_COMMENT'); ?>"
                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                ></textarea>
            </div>
            <div class="mb-5">
                <?php
                $APPLICATION->IncludeComponent("bitrix:main.file.input", "drag_n_drop",
                    array(
                        "INPUT_NAME"=>"images",
                        "MULTIPLE"=>"Y",
                        "MODULE_ID"=>"main",
                        "MAX_FILE_SIZE"=>"",
                        "ALLOW_UPLOAD"=>"I",
                        "ALLOW_UPLOAD_EXT"=>""
                    ),
                    false
                );
                ?>
            </div>
            <div>
                <button
                        type="submit"
                        class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none"
                >
                    <?= Loc::getMessage('TEMPLATE_BUTTON'); ?>
                </button>
            </div>
        </form>
    </div>
</div>
