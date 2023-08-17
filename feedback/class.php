<?php

use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\SystemException;

class Feedback extends CBitrixComponent implements Controllerable, Errorable
{
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
            // TODO Добавление результат в инфоблок или в модуль форм
            return [
                "result" => "Ваше сообщение принято",
            ];
        } catch (SystemException $e) {
            return [
                "result" => $e->getMessage(),
            ];
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