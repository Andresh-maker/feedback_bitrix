<?php

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\SystemException;

class Feedback extends CBitrixComponent implements Controllerable, Errorable
{
    protected const BLOCK_FEEDBACK_ID = 19;
    protected ErrorCollection $errorCollection;

    /**
     * Обработка параметров компонента
     * @param $arParams
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $this->errorCollection = new ErrorCollection();
        return $arParams;
    }

    /**
     * @inheritdoc
     * @return array|Error[]
     */
    public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    /**
     * @inheritdoc
     * @param $code
     * @return Error
     */
    public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Правила для ajax запроса
     * @return array[]
     */
    public function configureActions(): array
    {
        return [
            'sendMessage' => [
                'prefilters' => [],
            ],
        ];
    }

    /**
     * Обработка данных из формы
     * @param array $fields
     * @return array
     * @throws Error
     */
    public function sendMessageAction(array $fields): array
    {
        try {
            $this->validateForm($fields);
            $elementId = $this->addElement($fields);

            return [
                "result" => "Ваше сообщение принято. Номер заявки #$elementId",
            ];
        } catch (SystemException $e) {
            return [
                "result" => $e->getMessage(),
            ];
        }
    }

    /**
     * Запись данных в инфоблок
     * @param $fields
     * @return int|null
     * @throws SystemException
     */
    protected function addElement($fields): ?int
    {
        $el = new CIBlockElement;
        $PROP['FILE_LIST'] = $fields['files'];
        $PROP['EMAIL'] = $fields['email'];
        $PROP['PHONE'] = $fields['phone'];
        $PROP['COMMENT'] = $fields['message'];
        $arLoadProductArray = [
            "IBLOCK_ID"       => self::BLOCK_FEEDBACK_ID,
            "PROPERTY_VALUES" => $PROP,
            "NAME"            => $fields['name'],
        ];

        if($elementId = $el->Add($arLoadProductArray)) {
            return $elementId;
        } else {
            $this->errorCollection[] = new Error($el->LAST_ERROR);
            throw new SystemException('Ошибка добавления элемента');
        }
    }

    /**
     * Валидация формы
     * @param array $fields
     * @return void
     * @throws SystemException
     */
    private function validateForm(array $fields): void
    {
        if (empty($fields['name'])) {
            $this->errorCollection[] = new Error('Введите имя', 0, 'name');
        }

        if (empty($fields['phone'])) {
            $this->errorCollection[] = new Error('Введите телефон', 0, 'phone');
        }

        if (empty($fields['email'])) {
            $this->errorCollection[] = new Error('Введите email', 0, 'email');
        }

        if (!empty($this->errorCollection->getValues())) {
            throw new SystemException('Не корректно указаны данные в форме');
        }
    }

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }
}